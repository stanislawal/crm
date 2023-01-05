<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table = 'articles';
    protected $fillable = [
        'article', //статья
        'without_space', //кол-во знаков без пробелов
        'id_currency', //id валюты
        'gross_income', //валовый доход
        'link_text' //ссылка на текст
    ];

    public $timestamps = false;
}
