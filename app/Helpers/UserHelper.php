<?php
namespace App\Helpers;


class UserHelper
{

    //Возврвщает id аторизованного пользователя
    public static function getUserId(){
        return auth()->user()->id ?? null;
    }

    public static function isAdmin(){
        return auth()->user()->hasRole('Администратор');
    }

    public static function getRoleName(){
        $roles = auth()->user()->getRoleNames();
        return $roles[0] ?? 'Неопределено';
    }
}
