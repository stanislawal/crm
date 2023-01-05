<?php

namespace App\Models\Cross;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrossprojectArticle extends Model
{
    public $table = 'cross_project_articles';

    protected $fillable = [
        'article_id', //id пользователя
        'project_id' //id проекта
    ];

    public $timestamps = false;
}
