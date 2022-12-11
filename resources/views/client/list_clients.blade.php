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
                                <th>Имя</th>
                                <th>Соц.сети</th>
                                <th>Сфера деятельности</th>
                                <th>Сайт</th>
                                <th>Имя компании</th>
                                <th>Портрет</th>
                            </tr>
                            </thead>
                            <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td><a href="{{route('client.edit',['client'=> $client['id']])}}" >Открыть</a>
                                        </td>
                                        <td>{{$client['id']}}</td>
                                        <td>{{$client['name'] ?? '-'}}</td>
                                        <td>
                                            ВК
                                        </td>
                                        <td>{{$client['scope_work'] ?? '-'}}</td>
                                        <td>{{$client['site'] ?? '-'}}</td>
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
@endsection
