<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
       $users =  User::on()->get()->toArray();

        return view('user.list_users', [
            'users' => $users,
        ]);
    }

    //Страница создания (нахождения формы) пользователя
    public function create()
    {
        return view('user.user_create');
    }


    public function store(Request $request)
    {

        $attr = [
            'full_name' => $request->full_name,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'is_work' => true,
        ];

        $user = User::on()->create($attr);
        $user->assignRole($request->role);
        return redirect()->back()->with(['message' => 'Пользователь успешно добавлен']);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return view('user.user_edit');
    }


    public function update(Request $request, $id)
    {
        return view('user.user');
    }


    public function destroy($id)
    {
        //
    }
}
