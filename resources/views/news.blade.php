@extends('layouts.app')

@section('content')

  <!-- Bootstrap шаблон... -->

  <div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой задачи -->
    <form action="{{ url('newsitem/news') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}

      <!-- Имя задачи -->
      <div class="form-group">
        <label for="newsitem" class="col-sm-3 control-label">Новость</label>

        <div class="col-sm-6">
          <input type="text" name="name" id="task-name" class="form-control">
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
            <th>Newsitem</th>
            <th>&nbsp;</th>
            </thead>

            <!-- Тело таблицы -->
            <tbody>
                @foreach ($news as $newsitem)
                <tr>
                    <!-- Имя задачи -->
                    <td class="table-text">
                        <div>{{ $newsitem->name }}</div>
                    </td>

                    <td>
                        <form action="{{url('newsitem/news/'.$newsitem->id)}}" method="post">
                            {{ csrf_field()}}
                            {{method_field('delete')}}
                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        
                        </form>
                        <td>
                            <a href="{{url('newsitem/news/edit/'.$newsitem->id)}}" class="fa fa-edit"></a>
                    </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
  <!-- TODO: Текущие задачи -->
@endsection