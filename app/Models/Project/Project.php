<?php

namespace App\Models\Project;

use App\Models\Article;
use App\Models\Client\Client;
use App\Models\Cross\CrossprojectArticle;
use App\Models\Cross\CrossProjectClient;
use App\Models\User;
use App\Models\Status;
use App\Models\Project\Mood;
use App\Models\Project\Style;
use App\Models\Project\Theme;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cross\CrossProjectAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    public $table = 'projects';

    protected $fillable = [
        'created_user_id', //id пользователя, создавшего проект
        'manager_id', //id пользователя
        'theme_id', //id темы проекта
        'project_name', //имя проекта
        'mood_id', //настроение заказчика
        'pay_info', //информация об оплате
        'price_client', //цена заказчика
        'price_author', //цена автора
        'pay_method', //метод оплаты
        'start_date_project', // дата начала проекта
        'end_date_project', // дата конца проекта
        'total_symbols', //общее кол-во символов
        'progress_symbols', //сколько написано символов
        'contract', // договор
        'comment', // комментарий к проекту
        'style_id', // id стиля текса
        'status_id' //id состояния проекта
    ];

    public $timestamps = true;


    public function projectAuthor()
    {
        //Отношение многие ко многим. первый параметр - связь с конечной таблице. второй параметр - название промежуточной таблицы.
        return $this->belongsToMany(User::class, CrossProjectAuthor::class, 'project_id', 'user_id');
    }

    public function projectArticle()
    {
        //Отношение многие ко многим. первый параметр - связь с конечной таблице. второй параметр - название промежуточной таблицы.
        return $this->belongsToMany(Article::class, CrossprojectArticle::class, 'project_id', 'article_id');
    }

    public function projectStatus()
    {
        //Обратное отношение. прямая связь моделей
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function projectStyle()
    {
        return $this->belongsTo(Style::class, 'style_id');
    }

    public function projectMood()
    {
        return $this->belongsTo(Mood::class, 'mood_id');
    }

    public function projectUserCreate()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projectTheme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }

    public function projectUser()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function projectClients()
    {
        //Отношение многие ко многим. первый параметр - связь с конечной таблице. второй параметр - название промежуточной таблицы.
        return $this->belongsToMany(Client::class, CrossProjectClient::class, 'project_id', 'client_id');
    }

}
