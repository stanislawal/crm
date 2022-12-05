@extends('layout.markup')

@section('content')
<h2>Добавить нового клиента</h2>
<div class="shadow border p-4 my-3">
    <form action="{{route('client.store')}}" method="POST">
        @csrf
        <div class="row">
                    <div class="mb-3 col-6 col-md-4">
                        <label for="" class="form-label">Имя клиента</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                <div class="mb-3 col-6 col-md-4">
                    <label for="" class="form-label">Место ведения диалога</label>
                    <select class="form-control"  name="dialog_location" id="">
                        <option disabled value="">Места</option>
                       @foreach ($socialnetwork as $dialog)
                           <option value="{{$dialog['id']}}">{{$dialog['name']}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="mb-3 col-6 col-md-4">
                    <label for="" class="form-label">Сфера деятельности</label>
                    <input type="text" class="form-control" name="scope_work">
                </div>

            <div class="mb-3 col-6 col-md-4">
                <label for="" class="form-label">Сайт компании</label>
                <input type="text" class="form-control" name="company_name">
            </div>
            <div class="mb-3 col-6 col-md-4">
                <label for="" class="form-label">Портрет и общая хар-ка</label>
                <input type="text" class="form-control" name="characteristic">
            </div>
                    <div class="row">
                        <div class="col-6 col-md-4 d-flex align-items-center"><button class="btn btn-success">Send</button></div>
                    </div>
                </form>
            </div>
@endsection
