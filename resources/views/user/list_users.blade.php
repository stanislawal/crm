@extends('layout.markup')

@section('content')
    <div class="row p-0s">
        <div class="col-12">
            @include('Answer.custom_response')
            @include('Answer.validator_response')
        </div>
        {{--        {{dd($clients)}}--}}
        <div class="col-12">
            {{-- {{dd($clients)}} --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table  table-hover table-head-bg-info">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Ф.И.О</th>
                            <th>Логин</th>
                            <th>Должность</th>
                            <th>Статус работы</th>
                            <th>Создан</th>
                            <th>Обновлён</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><a href="{{route('user.edit',['user'=> $user['id']])}}">Открыть</a>
                                </td>
                                <td>{{$user['id']}}</td>
                                <td>{{$user['full_name'] ?? '-'}}</td>
                                <td>{{$user['login'] ?? '-'}}</td>
                                <td>Должность</td>
                                <td>@if($user['is_work'] == 1)
                                        Работает
                                    @else
                                        Не работает
                                    @endif</td>
                                <td>{{$user['created_at'] ?? '-'}}</td>
                                <td>{{$user['updated_at'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
