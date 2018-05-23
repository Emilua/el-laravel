<?php

use Carbon\Carbon;
use App\News;
use App\Task;
use Illuminate\Http\Request;

/**
 * Вывести панель с задачами
 */
Route::get('/', function () {
//    $task= new Task();
//    $tasks=$task->all();
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('tasks', ['tasks' => $tasks]);
});

/**
 * Добавить новую задачу
 */
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:6',
    ]);

    if ($validator->fails()) {
        return redirect('/')
                        ->withInput()
                        ->withErrors($validator);
    }
    var_dump($request->name);

    $task = new Task();
    $task->name = $request->name;
    $task->save();
    return redirect('/');
});

/**
 * Удалить задачу
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect('/');
});

Route::get('/task/edit/{task}', function (Task $task) {
    return view('taskedit', [
        'task' => $task,
    ]);
});
Route::post('/task/edit', function (Request $request) {

    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|min:6',
    ]);

    if ($validator->fails()) {
        return redirect('/task/edit/' . $request->id)
                        ->withInput()
                        ->withErrors($validator);
    }
    $task = Task::find($request->id);

    $task->name = $request->name;
    $task->save();
    return redirect('/');
});

/**
 * Вывести панель с задачами
 */
Route::get('/news', function () {
    $news = News::orderBy('created_at', 'asc')->get();
    return view('news', ['news' => $news]);
});
Route::post('/news', function (Request $request) {
    $news = new News();
    $news->name = $request->name;
    $news->text = $request->text;
    $news->save();
    return redirect('/news');
});
Route::delete('/news/{news}', function (News $news) {
    $news->delete();
    return redirect('/news');
});

Route::get('/news/edit/{news}', function (News $news) {
    return view('newsedit', [
        'news' => $news,
    ]);
});
Route::post('/news/edit', function (Request $request) {


    $news = News::find($request->id);

    $news->name = $request->name;
    $news->text = $request->text;
    $news->updated_at = Carbon::now('Europe/Kiev');
    $news->save();
    return redirect('/news');
});
