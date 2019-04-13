<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
	return view('blog.index');
});
Route::get('/post/{id}', function ($id) {
	return view('blog.post', ['id' => $id]);
})->name('post');
Route::get('admin/', function () {
	return view('admin.index');
})->name('admin.index');
Route::post('create', function (\Illuminate\Http\Request $request, \Illuminate\Validation\Factory $validator) {
	$validation = $validator->make($request->all(), [
		'title' => 'required|min:5',
		'content' => 'required|min:10',
	]);
	if ($validation->fails()) {
		return redirect()->back()->withErrors($validation);
	}
	return redirect()->route('admin.index')->with('info', 'Post created, Title: ' . $request->input('title'));

})->name('admin.create.new');
Route::get('admin/create', function () {
	return view('admin.create');
})->name('admin.create');
Route::get('admin/edit/{id}', function ($id) {
	return view('admin.edit');
})->name('admin.edit');
Route::get('/about', function () {
	return view('other.about');
});
Route::post('edit', function (\Illuminate\Http\Request $request,
	\Illuminate\Validation\Factory $validator) {
	$validation = $validator->make($request->all(), [
		'title' => 'required | min :5',
		'content' => 'required | min :10',
	]);
	if ($validation->fails()) {
		return redirect()->back()->withErrors($validation);
	}
	return redirect()->route('admin.index')->with('info', 'Post edited, new Title:' . $request->input('title'));
})->name('admin.update');