@extends('layout.markup')

@section('content')
    <div class="row p-0s">
        <div class="col-12">
            @include('Answer.custom_response')
            @include('Answer.validator_response')
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
                        <table id="basic-datatables" class="display table  table-hover table-head-bg-info">
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
                                    <td><a href="{{route('client.edit',['client'=> $client['id']])}}">Открыть</a></td>
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
