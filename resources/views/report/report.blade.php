@extends('layout.markup')

@section('title')
    Отчёт | {{ config('app.name') }}
@endsection

@section('content')
    <h2 class="mb-3">Отчет о проектах</h2>

    <div class="row m-0">
        <div class="col-lg-9 p-0">
            @include('Answer.custom_response')
            @include('Answer.validator_response')
        </div>
    </div>


@endsection
