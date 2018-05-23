@extends('layouts.app')

@section('content')

<!-- Bootstrap шаблон... -->

<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
@if(!empty($news))
    <!-- Форма новой задачи -->
    <form action="{{ url('/news/edit') }}" method="POST" class="form-horizontal" value="{{$news->name}}">
        {{ csrf_field() }}
        <input type="hidden"  name="id" value="{{$news->id}}"/>
        <!-- Имя задачи -->
        <div class="form-group">
            <label for="news" class="col-sm-3 control-label">Редактировать</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control" value="{{$news->name}}">
            </div>
            <div class="col-sm-6">
                <textarea name="text" id="news-name" class="form-control">{{$news->text}}</textarea>
            </div>

        </div>

        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Сохранить
                </button>
            </div>
        </div>
    </form>
    @else
    <p> no news for edit<a href="{{'/news'}}">to all news </a></p>
    @endif
</div>
@endsection