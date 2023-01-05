@extends('layout.markup')
@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
    <h2>Информация о проекте</h2>
    <div class="col-lg-12 p-0">
        @include('Answer.custom_response')
        @include('Answer.validator_response')
    </div>
    <div class="row m-0">
        <div class="col-12">
            <form class="shadow border rounded row mb-3" action="{{route('article.store')}}" method="post">
                <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">Создать статью
                    для проекта
                </div>
                @csrf
                <input type="hidden" value="{{$projectInfo['id']}}" name="project_id">
                <div class="w-100 row m-0 p-2">
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Статьи</label>
                        <input class="form-control form-control-sm" type="text" name="article" required>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">ЗБП</label>
                        <div class="input-group mb-3">
                            <input class="form-control form-control-sm" required type="number" step="0.1" min="0.1"
                                   name="without_space">
                        </div>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Валюта</label>
                        <div class="input-group mb-3">
                            <select required class="form-control form-control-sm" name="id_currency">
                                <option value="">Не выбрано</option>
                                @foreach ($currency as $item)
                                    <option value="{{$item['id']}}">{{$item['currency']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">ВД (валовый доход)</label>
                        <input required class="form-control form-control-sm" type="number" step="0.1" min="0.1"
                               name="gross_income">
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="" class="form-label">Ссылка на текст</label>
                        <input required class="form-control form-control-sm" type="text" name="link_text">
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-success btn-sm mr-3 w-auto">Создать</button>
                    </div>
                </div>
            </form>

            <div class="shadow border rounded row mb-3">

                <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom text-center bg-blue text-white">Все
                    статьи проекта
                </div>

                <div class="w-100 p-3">
                    <div class="row m-0">
                        @forelse($projectInfo['project_article'] as $i => $article)
                            <div class="col-12 col-lg-6 rounded mb-3">
                                <div class="w-100 text-14 px-2 py-1 border-bottom bg-blue text-white">Статья
                                    ID {{ $article['id'] }}</div>
                                <div class="row m-0 shadow border">
                                    <form action="{{route('article.update', ['article' => $article['id']])}}"
                                          method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="row m-0 w-100">
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="" class="form-label">Название статьи</label>
                                                <input class="form-control form-control-sm" type="text" name="article"
                                                       required value="{{$article['article']}}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="" class="form-label">ЗБП (знаки без пробелов)</label>
                                                <div class="input-group mb-3">
                                                    <input class="form-control form-control-sm" required type="number"
                                                           step="0.1" min="0.1"
                                                           name="without_space" value="{{$article['without_space']}}">
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="" class="form-label">Валюта</label>
                                                <div class="input-group mb-3">
                                                    <select required class="form-control form-control-sm"
                                                            name="id_currency">
                                                        @foreach ($currency as $item)
                                                            <option value="{{$item['id']}}"
                                                                    @if($item['id'] == $article['id_currency']) selected @endif
                                                            >{{$item['currency']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="" class="form-label">ВД (валовый доход)</label>
                                                <input required class="form-control form-control-sm" type="number"
                                                       step="0.1" min="0.1" name="gross_income"
                                                       value="{{$article['gross_income']}}">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="" class="form-label">Ссылка на текст</label>
                                                <input required class="form-control form-control-sm" type="text"
                                                       name="link_text" value="{{$article['link_text']}}">
                                            </div>
                                            <div class="form-group col-12 d-flex justify-content-between">
                                                <a href="{{route('article.destroy', ['article' => $article['id']])}}"
                                                   class="btn btn-sm btn-danger">Удалить</a>
                                                <button class="btn btn-sm btn-success">Обновить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-danger text-14">Статьи отсутствуют в этом проекте</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form action="{{route('project.update', ['project' => $projectInfo['id']])}}" method="POST"
          data-form-name="edit__project">
        @csrf
        @method('PUT')
        <div class="row m-0">
            <div class="col-12">

                <div class="shadow border rounded row mb-3">
                    <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">О проекте
                    </div>
                    <div class="w-100 row m-0 p-2">
                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Менеджер</label>
                            <select class="form-control form-control-sm" name="manager_id" disabled
                                    value="{{ $projectInfo['manager_id'] ?? '' }}">
                                <option value="">Не выбрано</option>
                                @foreach ($managers as $manager)
                                    <option value="{{$manager['id']}}">{{$manager['full_name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Тема</label>
                            <select class="form-control form-control-sm" name="theme_id" disabled
                                    value="{{ $projectInfo['theme_id'] ?? '' }}">
                                @foreach ($themes as $theme)
                                    <option value="{{$theme['id']}}">{{$theme['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Название проекта</label>
                            <input type="text" class="form-control form-control-sm" name="project_name" disabled
                                   value="{{ $projectInfo['project_name'] ?? '' }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Тип текста (стиль)</label>

                            <select class="form-control form-control-sm" title="Пожалуйста, выберите" name="style_id"
                                    disabled
                                    value="{{ $projectInfo['style_id'] ?? '' }}">
                                @foreach ($style as $item)
                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Начальный объём проекта</label>
                            <input type="text" class="form-control form-control-sm" name="total_symbols" disabled
                                   value="{{ $projectInfo['total_symbols'] ?? '' }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Дата поступления тз</label>
                            <input type="date" class="form-control form-control-sm" name="start_date_project"
                                   disabled value="{{ $projectInfo['start_date_project'] ?? '' }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Комментарий</label>
                            <textarea type="text" rows="4" class="form-control form-control-sm" name="comment"
                                      placeholder="Укажите комментарий к проекту"
                                      disabled>{{ $projectInfo['comment'] ?? '' }}</textarea>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Назначить авторов</label>
                            <select class="form-control form-control-sm select-2" multiple name="author_id[]" disabled>
                                @foreach ($authors as $author)
                                    <option
                                        @if(in_array($author['id'], collect($projectInfo['project_author'])->pluck('id')->toArray()))
                                            selected
                                        @endif value="{{$author['id']}}">{{$author['full_name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Состояние проекта </label>
                            <select class="form-control form-control-sm" name="status_id" disabled
                                    value="{{ $projectInfo['status_id'] ?? '' }}">
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
                    <div class="w-100 text-18 px-3 py-2 font-weight-bold border-bottom bg-blue text-white">Цена и
                        оплата
                    </div>
                    <div class="w-100 row m-0 p-2">
                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Как платит</label>
                            <input type="text" class="form-control form-control-sm" name="pay_info"
                                   disabled value="{{ $projectInfo['pay_info'] ?? '' }}">
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Цена заказчика</label>
                            <div class="input-group mb-3">
                                <input class="form-control form-control-sm" type="number" step="0.1" min="0.1"
                                       name="price_client"
                                       disabled value="{{ $projectInfo['price_client'] ?? '' }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">РУБ</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Цена автора</label>
                            <div class="input-group mb-3">
                                <input class="form-control form-control-sm" type="number" step="0.1" min="0.1"
                                       name="price_author"
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

                        {{--                    @dd()--}}

                        <div class="form-group col-12">
                            <label for="" class="form-label">Заказчики</label>
                            <select class="form-control form-control-sm select-2" multiple title="Пожалуйста, выберите"
                                    name="client_id[]" disabled>
                                <option value="">Не выбрано</option>
                                @foreach ($clients as $client)
                                    <option value="{{$client['id']}}"
                                            @if(in_array($client['id'], collect($projectInfo['project_clients'])->pluck('id')->toArray()))
                                                selected
                                        @endif
                                    >{{$client['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Договор</label>
                            <select class="form-control form-control-sm" name="contract" disabled>
                                <option value="1" @if($projectInfo['contract'] == true) selected @endif>Да</option>
                                <option value="0" @if($projectInfo['contract'] == false) selected @endif>Нет</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-lg-6">
                            <label for="" class="form-label">Настроение</label>
                            <select class="form-control form-control-sm" name="mood_id" disabled
                                    value="{{ $projectInfo['mood_id'] ?? '' }}">
                                @foreach ($moods as $mood)
                                    <option value="{{$mood['id']}}">{{$mood['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="shadow border rounded row mb-3">
                    <div class="w-100 row m-0 p-3">
                        <div class="btn btn-primary btn-sm mr-3 w-auto" data-role="edit"
                             onclick="onEdit('edit__project', false)">
                            Редактировать
                        </div>
                        <button class="btn btn-success btn-sm mr-3 w-auto" style="display: none;">Обновить</button>
                        <div class="btn btn-danger btn-sm mr-3 w-auto" style="display: none;" data-role="cancel"
                             onclick="onEdit('edit__project', true)">Отмена
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
@section('custom_js')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/select2.js')}}"></script>
@endsection
