@extends('layout.markup')

@section('content')
<h2>Добавление статусов</h2>
    <div>
        <div class="shadow border p-4 my-3">
                <form action="{{route('add_option_status.store')}}" method="POST">
                    @csrf
                    <div class="mb-3 col-6 col-md-4">
                        <label for="" class="form-label mb-3">Добавить новый статус</label>
                        <input type="text" class="form-control form-control " name="add_new_status">
                        <button type="success" class="btn btn-sm btn-success mt-3">Добавить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>Название статуса</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $item)
                        <tr>
                            <td>{{$item['id']}}</td>
                            <td>{{$item['name']}}</td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
