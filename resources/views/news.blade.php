@extends('layouts.app')

@section('content')

<!-- Bootstrap шаблон... -->

<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой задачи -->
    <form action="{{ url('/news') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Имя задачи -->
        <div class="form-group">
            <label for="news" class="col-sm-3 control-label">Новость</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="news-name" class="form-control">
            </div>
            <div class="col-sm-6">
                <textarea name="text" id="news-name" class="form-control"></textarea>
            </div>
        </div>

        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить новость
                </button>
            </div>
        </div>
    </form>
</div>
@if (count($news) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Текущая новость
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- Заголовок таблицы -->
            <thead>
            <th>News</th>
            <th>&nbsp;</th>
            </thead>

            <!-- Тело таблицы -->
            <tbody>
                @foreach ($news as $news_item)
                <tr>
                    <!-- Имя задачи -->
                    <td class="table-text">
                        <div title="{{ $news_item->text }}">{{ $news_item->name }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $news_item->text }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $news_item->updated_at }}</div>
                    </td>

                    <td>
                        <form action="{{url('/news/'.$news_item->id)}}" method="post">
                            {{ csrf_field()}}
                            {{method_field('delete')}}
                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        
                        </form>
                        <td>
                            <a href="{{url('/news/edit/'.$news_item->id)}}" class="fa fa-edit"></a>
                    </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection