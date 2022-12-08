@extends('layout.markup')

@section('content')
    <div class="row p-0s">
        <div class="col-12">
            @include('Answer.custom_response')
            @include('Answer.validator_response')
        </div>

        <div class="col-12 mb-3">
            <div class="w-100 shadow border rounded p-3">
                <div class="btn btn-sm btn-secondary" onclick="searchToggle()"><i
                        class="fa fa-search search-icon mr-2"></i>Поиск
                </div>
                <form action="{{ route('project.index') }}" method="GET">
                    @csrf
                    <div class="row m-0" id="search"  @if(empty(request()->all())) style="display: none;" @endif>
                        <div class="w-100 row m-0 py-3">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">ID</label>
                                <input type="text" class="form-control" name="id" value="{{ request()->id ?? '' }}">
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Менеджер</label>
                                <select class="form-control" name="manager_id">
                                    <option value="">Не выбрано</option>
                                    @foreach ($managers as $manager)
                                        <option value="{{$manager['id']}}">{{$manager['full_name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Название проекта</label>
                                <input type="text" class="form-control" name="project_name"
                                       value="{{ request()->project_name ?? '' }}">
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Цена заказчика</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" step="0.01" min="0.01" name="price_client" value="{{ request()->price_client ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">РУБ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Цена автора</label>
                                <div class="input-group">
                                    <input class="form-control" type="number" step="0.01" min="0.01" name="price_author" value="{{ request()->price_author ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">РУБ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Договор</label>
                                <select class="form-control" name="contract">
                                    <option value="">Не выбрано</option>
                                    <option value="1">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="" class="form-label">Статус</label>
                                <select class="form-control" name="status_id" id="">
                                    <option value="">Не выбрано</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{$status['id']}}"
                                                @if($status['id'] == \App\Constants\StatusConstants::DRAFT)
                                                selected
                                            @endif
                                        >{{$status['name']}}</option>
                                    @endforeach
                                </select>
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
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Администрирование проектов</h4>
                        <div class="text-16">Найдено записей: {{ count($projects) }}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">



                        <table id="basic-datatables" class="display table  table-hover table-head-bg-info">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Менеджер</th>
                                <th>Заказчик</th>
                                <th>Проект</th>
                                <th>Тема</th>
                                <th>Цена заказчика</th>
                                <th>Цена Автора</th>
                                <th>Договор</th>
                                <th>Статус</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td><a href="{{route('project.edit',['project'=> $project['id']])}}">Открыть</a>
                                    </td>
                                    <td>{{$project['id']}}</td>
                                    <td>{{$project['project_user']['full_name'] ?? '-'}}</td>
                                    <td>
                                        @forelse ($project['project_clients'] as $client)
                                            {{ $client['name'] }}
                                        @empty
                                            -
                                        @endforelse
                                    </td>
                                    <td>{{$project['project_name']}}</td>
                                    <td>{{$project['project_theme']['name']}}</td>
                                    <td>{{ $project['price_client'] ?? '-' }}</td>
                                    <td>{{ $project['price_author'] ?? '-' }}</td>
                                    <td>@if($project['contract'] == 0)
                                            Нет
                                        @else
                                            Да
                                        @endif</td>
                                    <td>{{$project['project_status']['name']}}</td>
                                    <td>{{Illuminate\Support\Carbon::parse($project['start_date_project'])->format('d.m.Y')}}</td>
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
