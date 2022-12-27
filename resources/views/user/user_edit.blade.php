@extends('layout.markup')
@section('content')
    @extends('layout.markup')

    @section('title')
        Пользователи | {{ config('app.name') }}
    @endsection

    @section('content')
        <form action="{{route('user.edit')}}" method="POST">
            @method('PUT')
            @csrf
            <div class="shadow border rounded row mb-3">
                <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">Добавить пользователя</div>
                <div class="w-100 row m-0 p-2">
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Ф.И.О</label>
                        <input type="text" required class="form-control" name="full_name">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Логин</label>
                        <input type="text" required class="form-control" name="login">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Пароль</label>
                        <input type="password" required class="form-control" name="password">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Роль</label>
                        <select class="form-control" required name="role" id="">
                            <option disabled value="">Роль</option>
                            <option value="Администратор">Администратор</option>
                            <option value="Менеджер">Менеджер</option>
                            <option value="Автор">Автор</option>
                        </select>
                    </div>
                </div>
                <div class="w-100 row m-0 p-3">
                    <button class="btn btn-success" type="submit">Создать</button>
                </div>
            </div>

        </form>
    @endsection

@endsection
