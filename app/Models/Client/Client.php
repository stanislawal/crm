<?php

namespace App\Models\Client;

use App\Models\Cross\CrossClientSocialNetwork;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Helper\Table;

class Client extends Model
{
    public $table = 'clients';

    protected $fillable = [
        'name', //имя клиента
        'dialog_location', //место проведения диалога
        'scope_work', //сфера деятельности
        'characteristic', //характеристика клиента
        'company_name', //Название компании
        'site' //сайт компании
    ];

    public $timestamps = true;

    public function socialNetwork(){
        //Отношение многие ко многим. первый параметр - связь с конечной таблице. второй параметр - название промежуточной таблицы.
        return $this->belongsToMany(SocialNetwork::class, CrossClientSocialNetwork::class)->withPivot('description');
    }
}


