<?php

namespace App\Models\Cross;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrossProjectAuthor extends Model
{
    public $table = 'cross_project_authors';

    protected $fillable = [
        'user_id', //id пользователя
        'project_id' //id проекта
    ];

    public $timestamps = false;
}
