<?php

namespace App\Http\Controllers\Project;

use App\Helpers\UserHelper;
use App\Models\Cross\CrossProjectAuthor;
use App\Models\Cross\CrossProjectClient;
use App\Models\Status;
use App\Models\Project\Mood;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Client\Client;
use App\Models\Project\Style;
use App\Models\Project\Theme;
use App\Models\Project\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    //Для отображения (вывода) всех записей
    public function index()
    {
        $clients = Client::on()->get()->toArray(); //Достаем всех клиентов (заказчиков)
        $themes = Theme::on()->get()->toArray(); //Достаем все темы проектов
        $moods = Mood::on()->get()->toArray(); //достаем все настроения из бд
        $statuses = Status::on()->get()->toArray(); //Достаем все статусы из бд
        $style = Style::on()->get()->toArray();
        $managers = User::on()->whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->get();
        $authors = User::on()->whereHas('roles', function ($query) {
            $query->where('id', 3);
        })->get();

        $projects = Project::on()->with([
            'projectTheme',
            'projectUser',
            'projectStatus',
            'projectClients'
        ])
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        return view('project.list_projects', [
            'projects' => $projects,
            'statuses' => $statuses,
            'moods' => $moods,
            'themes' => $themes,
            'clients' => $clients,
            'style' => $style,
            'managers' => $managers,
            'authors' => $authors,
        ]);
    }

    //Страница формы создания. Возвращаем view на которой форма создания
    public function create()
    {
        $clients = Client::on()->get()->toArray(); //Достаем всех клиентов (заказчиков)
        $themes = Theme::on()->get()->toArray(); //Достаем все темы проектов
        $moods = Mood::on()->get()->toArray(); //достаем все настроения из бд
        $statuses = Status::on()->get()->toArray(); //Достаем все статусы из бд
        $style = Style::on()->get()->toArray();
        $managers = User::on()->whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->get();
        $authors = User::on()->whereHas('roles', function ($query) {
            $query->where('id', 3);
        })->get();

        //передаем данные в view
        return view('project.projects_create', [
            'statuses' => $statuses,
            'moods' => $moods,
            'themes' => $themes,
            'clients' => $clients,
            'style' => $style,
            'managers' => $managers,
            'authors' => $authors,
        ]);
    }

    //Сюда приходят данные из формы и записывает в базу
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $attr = [
                'manager_id' => $request->manager_id ?? null,
                'theme_id' => $request->theme_id ?? null,
                'total_symbols' => $request->total_symbols ?? null,
                'project_name' => $request->project_name ?? null,
                'mood_id' => $request->mood_id ?? null,
                'status_id' => $request->status_id ?? null,
                'pay_info' => $request->pay_info ?? null,
                'price_client' => $request->price_client ?? null,
                'price_author' => $request->price_author ?? null,
                'start_date_project' => $request->start_date_project ?? null,
                'contract' => $request->contract ?? null,
                'comment' => $request->comment ?? null,
                'style_id' => $request->style_id ?? null,
                'characteristic' => $request->characteristic ?? null,
                'created_user_id' => UserHelper::getUserId()
            ];

            $project_id = Project::on()->create($attr)->id;

            if ($request->has('author_id') && count($request->author_id) > 0) {
                $authors = [];

                foreach ($request->author_id as $author) {
                    $authors[] = [
                        'project_id' => $project_id,
                        'user_id' => $author
                    ];
                }

                CrossProjectAuthor::on()->insert($authors);
            }

            if ($request->has('client_id') && count($request->client_id) > 0) {
                $clients = [];

                foreach ($request->client_id as $client) {
                    $clients[] = [
                        'project_id' => $project_id,
                        'client_id' => $author
                    ];
                }

                CrossProjectClient::on()->insert($clients);

            }

            DB::commit();

            return redirect()->route('project.index')->with(['success' => 'Новый проект успешно создан.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Произошла ошибка при создании проекта.']);
        }
    }

    //Вывести информацию об одной записи
    public function show($project)
    {

    }

    //Страница редактирования одной записи
    public function edit($project)
    {
        $clients = Client::on()->get()->toArray(); //Достаем всех клиентов (заказчиков)
        $themes = Theme::on()->get()->toArray(); //Достаем все темы проектов
        $moods = Mood::on()->get()->toArray(); //достаем все настроения из бд
        $statuses = Status::on()->get()->toArray(); //Достаем все статусы из бд
        $style = Style::on()->get()->toArray();
        $managers = User::on()->whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->get();

        $authors = User::on()->whereHas('roles', function ($query) {
            $query->where('id', 3);
        })->get();

        $projectInfo = Project::on()
            ->with(['projectTheme', 'projectUser', 'projectStatus', 'projectClients'])
            ->find($project)
            ->toArray();

        return view('project.project_edit', [
            'projectInfo' => $projectInfo,
            'statuses' => $statuses,
            'moods' => $moods,
            'themes' => $themes,
            'clients' => $clients,
            'style' => $style,
            'managers' => $managers,
            'authors' => $authors,
        ]);
    }

    //Обновляет запись (в бд)
    public function update(Request $request, $project)
    {
        $attr = [
            'manager_id' => $request->manager_id ?? null,
            'theme_id' => $request->theme_id ?? null,
            'total_symbols' => $request->total_symbols ?? null,
            'project_name' => $request->project_name ?? null,
            'mood_id' => $request->mood_id ?? null,
            'status_id' => $request->status_id ?? null,
            'pay_info' => $request->pay_info ?? null,
            'price_client' => $request->price_client ?? null,
            'price_author' => $request->price_author ?? null,
            'start_date_project' => $request->start_date_project ?? null,
            'contract' => $request->contract ?? null,
            'comment' => $request->comment ?? null,
            'style_id' => $request->style_id ?? null,
//            'characteristic' => $request->characteristic ?? null,
            'created_user_id' => UserHelper::getUserId()
        ];

        Project::on()->where('id', $project)->update($attr);

        return redirect()->back()->with(['success' => 'Данные успешно обновлены.']);
    }

    //Удалить запись
    public function destroy($id)
    {
        //
    }
}
