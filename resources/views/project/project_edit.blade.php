@extends('layout.markup')

@section('content')

    <h2>Информация о проекте</h2>

    <form action="{{route('project.update', ['project' => $projectInfo['id']])}}" method="POST" data-form-name="edit__project">
        @csrf
        @method('PUT')
        <div class="row m-0">
            <div class="col-12">
                <div class="shadow border rounded row mb-3">
                    <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">О проекте</div>

                    <div class="w-100 row m-0 p-2">
                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Менеджер</label>
                            <select class="form-control" name="manager_id" disabled value="{{ $projectInfo['manager_id'] ?? '' }}">
                                <option value="">Не выбрано</option>
                                @foreach ($managers as $manager)
                                    <option value="{{$manager['id']}}">{{$manager['full_name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Тема</label>
                            <select class="form-control" name="theme_id" disabled value="{{ $projectInfo['theme_id'] ?? '' }}">
                                @foreach ($themes as $theme)
                                    <option value="{{$theme['id']}}">{{$theme['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Название проекта</label>
                            <input type="text" class="form-control" name="project_name" disabled value="{{ $projectInfo['project_name'] ?? '' }}">
                        </div>


                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Тип текста (стиль)</label>

                            <select class="form-control" title="Пожалуйста, выберите" name="style_id" disabled value="{{ $projectInfo['style_id'] ?? '' }}">
                                @foreach ($style as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Начальный объём проекта</label>
                            <input type="text" class="form-control" name="total_symbols" disabled value="{{ $projectInfo['total_symbols'] ?? '' }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Дата поступления тз</label>
                            <input type="date" class="form-control" name="start_date_project"
                                   disabled value="{{ $projectInfo['start_date_project'] ?? '' }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Комментарий</label>
                            <textarea type="text" rows="4" class="form-control" name="comment"
                                      placeholder="Укажите комментарий к проекту"
                                      disabled>{{ $projectInfo['comment'] ?? '' }}</textarea>
                        </div>


                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Назначить авторов</label>
                            <select class="form-control" multiple size="4" name="author_id[]" disabled>
                                <option value="">Не выбрано</option>
                                @foreach ($authors as $author)
                                    <option value="{{$author['id']}}">{{$author['full_name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Состояние проекта </label>
                            <select class="form-control" name="status_id" disabled value="{{ $projectInfo['status_id'] ?? '' }}">
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
                            <input type="text" class="form-control" name="pay_info"
                                   disabled value="{{ $projectInfo['pay_info'] ?? '' }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Цена заказчика</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.1" min="0.1" name="price_client"
                                       disabled value="{{ $projectInfo['price_client'] ?? '' }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">РУБ</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Цена автора</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" step="0.1" min="0.1" name="price_author"
                                       disabled value="{{ $projectInfo['price_author'] ?? '' }}">
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
                            <select class="form-control" multiple size="5" title="Пожалуйста, выберите"
                                    name="client_id[]" disabled>
                                <option value="">Не выбрано</option>
                                @foreach ($clients as $client)
                                    <option value="{{$client['id']}}">{{$client['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Договор</label>
                            <select class="form-control" name="contract" disabled value="{{ $projectInfo['contract'] ?? '' }}">
                                <option value="">Выбрать</option>
                                <option value="1">Да</option>
                                <option value="0">Нет</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Настроение</label>
                            <select class="form-control" name="mood_id" disabled value="{{ $projectInfo['mood_id'] ?? '' }}">
                                @foreach ($moods as $mood)
                                    <option value="{{$mood['id']}}">{{$mood['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="shadow border rounded row mb-3">
                    <div class="w-100 row m-0 p-3">
                        <div class="btn btn-primary mr-3" data-role="edit" onclick="onEdit('edit__project', false)">Редактировать</div>
                        <button class="btn btn-success mr-3" style="display: none;">Обновить</button>
                        <div class="btn btn-danger mr-3" style="display: none;" data-role="cancel" onclick="onEdit('edit__project', true)">Отмена</div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
