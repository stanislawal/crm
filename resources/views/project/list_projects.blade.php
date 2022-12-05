@extends('layout.markup')

@section('content')
    <div class="row p-0s">
        <div class="col-12">
            @include('Answer.custom_response')
            @include('Answer.validator_response')
        </div>

        <div class="col-12 mb-3">
            <div class="w-100 shadow border rounded p-3">
                <div class="btn btn-secondary" onclick="searchToggle()"><i class="fa fa-search search-icon mr-3"></i>Поиск
                </div>
                <div class="row py-3 m-0" id="search" style="display: none">
                    <div class="form-group col-12 col-lg-4">
                        <label for="" class="form-label">Дата поступления тз</label>
                        <input type="date" class="form-control" name="start_date_project"
                               value="{{ now()->format('Y-m-d') }}" disabled
                               value="{{ $projectInfo['start_date_project'] ?? '' }}">
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="" class="form-label">Дата поступления тз</label>
                        <input type="date" class="form-control" name="start_date_project"
                               value="{{ now()->format('Y-m-d') }}" disabled
                               value="{{ $projectInfo['start_date_project'] ?? '' }}">
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="" class="form-label">Дата поступления тз</label>
                        <input type="date" class="form-control" name="start_date_project"
                               value="{{ now()->format('Y-m-d') }}" disabled
                               value="{{ $projectInfo['start_date_project'] ?? '' }}">
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="" class="form-label">Дата поступления тз</label>
                        <input type="date" class="form-control" name="start_date_project"
                               value="{{ now()->format('Y-m-d') }}" disabled
                               value="{{ $projectInfo['start_date_project'] ?? '' }}">
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="" class="form-label">Дата поступления тз</label>
                        <input type="date" class="form-control" name="start_date_project"
                               value="{{ now()->format('Y-m-d') }}" disabled
                               value="{{ $projectInfo['start_date_project'] ?? '' }}">
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="" class="form-label">Дата поступления тз</label>
                        <input type="date" class="form-control" name="start_date_project"
                               value="{{ now()->format('Y-m-d') }}" disabled
                               value="{{ $projectInfo['start_date_project'] ?? '' }}">
                    </div>
                    <div class="form-group col-12 col-lg-4">
                        <label for="" class="form-label">Дата поступления тз</label>
                        <input type="date" class="form-control" name="start_date_project"
                               value="{{ now()->format('Y-m-d') }}" disabled
                               value="{{ $projectInfo['start_date_project'] ?? '' }}">
                    </div>
                    <div class="col-12 p-0">
                        <div class="form-group col-12">
                            <div class="b-flex justify-content-end">
                                <div>
                                    <button class="btn btn-success">Искать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Администрирование проектов</h4>
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
                                    <td>{{$project['project_user']['full_name']}}</td>
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
