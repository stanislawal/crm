@extends('layout.markup')

@section('content')

    <div class="row p-0s">
        <div class="col-12 mb-3">
            <div class="w-100 shadow border rounded p-3 mb-3">
                <div class="btn btn-sm btn-secondary ml-3" onclick="searchToggle()"><i
                        class="fa fa-search search-icon mr-2"></i>Поиск
                </div>
                <form action="{{ route('project.index') }}" class="mt-3" method="GET">
                    @csrf
                    <div class="row m-0" id="search" @if(empty(request()->all())) style="display: none;" @endif>
                        <div class="w-100 row m-0 py-3">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">ID</label>
                                <input type="text" class="form-control" name="id" value="{{ request()->id ?? '' }}">
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Имя</label>
                                <input type="text" class="form-control" name="name" value="{{ request()->id ?? '' }}">
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Сфера деятельности</label>
                                <input type="text" class="form-control" name="scope_work"
                                       value="{{ request()->project_name ?? '' }}">
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Название компании</label>
                                <input class="form-control" type="text" name="company_name"
                                       value="{{ request()->price_client ?? '' }}">

                            </div>
                        </div>
                        <div class="col-12 p-0">
                            <div class="form-group col-12">
                                <div class="w-100 d-flex justify-content-end">
                                    @if(!empty(request()->all() && count(request()->all())) > 0)
                                        <a href="{{ route('project.index') }}" class="btn btn-sm btn-danger mr-3">Сбросить фильтр</a>
                                    @endif
                                    <button class="btn btn-sm btn-success">Искать</button>
                                </div>
                            </div>
                        </div>
                    </div>



            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Администрирование заказчиков</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables"
                                   class="display table  table-hover table-head-bg-info">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Сфера деятельности</th>
                                    <th>Имя компании</th>
                                    <th>Портрет</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            <a href="{{route('client.edit',['client'=> $client['id']])}}">Открыть</a>
                                        </td>
                                        <td>{{$client['id']}}</td>
                                        <td>{{$client['name'] ?? '-'}}</td>
                                        <td>{{$client['scope_work'] ?? '-'}}</td>
                                        <td>{{$client['company_name'] ?? '-'}}</td>
                                        <td>{{$client['characteristic'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
