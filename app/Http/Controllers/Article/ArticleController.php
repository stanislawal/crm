<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Cross\CrossprojectArticle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function React\Promise\all;

class ArticleController extends Controller
{
    /**
     * Создание статьи
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $attr = $request->only(['article', 'without_space', 'id_currency', 'gross_income', 'link_text']);
            $id = Article::on()->create($attr)->id;
            $projectId = $request->project_id;
            CrossprojectArticle::on()->create([
                'article_id' => $id,
                'project_id' => $projectId,
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => 'Статья успешно создана']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $request = $request->only(['article', 'without_space', 'id_currency', 'gross_income', 'link_text']);
        Article::on()->where('id', $id)->update($request);
        return redirect()->back()->with(['success' => 'Статья успешно обновлена']);
    }

    /**
     * Удалить статью
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        CrossprojectArticle::on()->where('article_id', $id)->delete();
        Article::on()->where('id', $id)->delete();
        return redirect()->back()->with(['success' => 'Статья успешно удалена']);
    }
}
