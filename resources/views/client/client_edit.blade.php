@extends('layout.markup')
@section('content')

    <h2 class="mb-3">Редактирование клиента</h2>


    <div class="row m-0">
        <div class="col-lg-9 p-0">
            @include('Answer.custom_response')
            @include('Answer.validator_response')
        </div>
    </div>
{{--    @dd($clients)--}}
    <form action="{{route('client.update', ['client' => $clients['id']])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row m-0">
            <div class="col-12">
                <div class="shadow border rounded row mb-3">
                    <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">О клиенте
                    </div>


                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Имя клиента</label>
                        <input type="text" value="{{$clients['name']}}"  class="form-control" name="name">
                    </div>



                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Сфера деятельности</label>
                            <input type="text" value="{{$clients['scope_work']}}" class="form-control" name="scope_work">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Имя компании</label>
                            <input type="text" value="{{$clients['company_name']}}" class="form-control" name="company_name">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Сайт</label>
                            <input type="text" value="{{$clients['site']}}" class="form-control" name="site">
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Портрет и общая хар-ка</label>
                            <input type="text" value="{{$clients['characteristic']}}" class="form-control" name="characteristic">
                        </div>
                    </div>
                <div class="shadow border rounded row mb-3">
                    <div class="w-100 row m-0 p-3">
                        <button class="btn btn-success">Редактировать</button>
                    </div>
                </div>
                </div>
            </div>
    </form>



@endsection
