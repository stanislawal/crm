@extends('layout.markup')

@section('content')

    <h2 class="mb-3">Добавить новый проект</h2>


    <div class="row m-0">
        <div class="col-lg-9 p-0">
            @include('Answer.custom_response')
            @include('Answer.validator_response')
        </div>
    </div>

    <form action="{{route('project.store')}}" method="POST">
        @csrf
        <div class="row m-0">
            <div class="col-12">
                <div class="shadow border rounded row mb-3">
                    <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">О проекте
                    </div>

                    <div class="w-100 row m-0 p-2">
                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Менеджер</label>
                            <select class="form-control" required name="manager_id">
                                <option value="">Не выбрано</option>
                                @foreach ($managers as $manager)
                                    <option value="{{$manager['id']}}">{{$manager['full_name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Тема</label>
                            <select class="form-control" required name="theme_id">
                                @foreach ($themes as $theme)
                                    <option value="{{$theme['id']}}">{{$theme['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Название проекта</label>
                            <input type="text" class="form-control" name="project_name">
                        </div>


                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Тип текста (стиль)</label>

                            <select class="form-control" required title="Пожалуйста, выберите" name="style_id">
                                @foreach ($style as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Начальный объём проекта</label>
                            <input type="text"required class="form-control" name="total_symbols">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Дата поступления тз</label>
                            <input type="date" required class="form-control" name="start_date_project"
                                   value="{{ now()->format('Y-m-d') }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Комментарий</label>
                            <textarea type="text" required rows="4" class="form-control" name="comment"
                                      placeholder="Укажите комментарий к проекту"></textarea>
                        </div>


                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Назначить авторов</label>
                            <select class="form-control" required multiple size="4" name="author_id[]">
                                <option value="">Не выбрано</option>
                                @foreach ($authors as $author)
                                    <option value="{{$author['id']}}">{{$author['full_name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Состояние проекта </label>
                            <select class="form-control" required name="status_id" id="">
                                @foreach ($statuses as $status)
                                    <option value="{{$status['id']}}"
                                            @if($status['id'] == \App\Constants\StatusConstants::DRAFT)
                                            selected
                                        @endif
                                    >{{$status['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="shadow border rounded row mb-3">
                    <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">Цена и оплата
                    </div>
                    <div class="w-100 row m-0 p-2">
                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Как платит</label>
                            <input type="text" required class="form-control" name="pay_info">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Цена заказчика</label>
                            <div class="input-group mb-3">
                                <input class="form-control" required type="number" step="0.1" min="0.1" name="price_client">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">РУБ</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Цена автора</label>
                            <div class="input-group mb-3">
                                <input class="form-control" required type="number" step="0.1" min="0.1" name="price_author">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">РУБ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow border rounded row mb-3">
                    <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">Заказчик
                    </div>
                    <div class="w-100 row m-0 p-2">

                        <div class="form-group col-12">
                            <label for="" class="form-label">Заказчики</label>
                            <select class="form-control" required multiple size="5" title="Пожалуйста, выберите"
                                    name="client_id[]">
                                <option value="">Не выбрано</option>
                                @foreach ($clients as $client)
                                    <option value="{{$client['id']}}">{{$client['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Портрет клиента</label>
                            <input type="text" class="form-control" required name="characteristic">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Договор</label>
                            <select class="form-control" required name="contract">
                                <option disabled>Выбрать</option>
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Настроение</label>
                            <select class="form-control" required name="mood_id">
                                @foreach ($moods as $mood)
                                    <option value="{{$mood['id']}}">{{$mood['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="shadow border rounded row mb-3">
                    <div class="w-100 row m-0 p-3">
                        <button class="btn btn-success">Создать</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
