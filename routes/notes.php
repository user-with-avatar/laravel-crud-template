<?php

use BcMath\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){return view('main');});

Route::get('/note/{id}', function (string $id) {
	# get note from db by id
	$data = DB::table('notes')->where('id', $id)->first();
	# pass everything about note to frontend
	return view('note', [
		'author'=>DB::table('users')->where('id', $data->author)->value('name'),
		'author_id'=>$data->author,
		'title'=>$data->title,
		'data'=>$data->data,
		'id'=>$data->id
		]);
});

Route::get('/list/{page}', function(string $page) {
	$MAX_PER_PAGE = env('MAX_PER_PAGE');
	$data = DB::table('notes')->where('id', '>', (int)$page*$MAX_PER_PAGE)->take($MAX_PER_PAGE)->get();
	for ($i=0; $i < count($data); $i++) { 
		$data[$i]->author_name = DB::table('users')->where('id', $data[$i]->author)->value('name');
	}
	return view('list', ['entries'=>$data, 'page'=>(int)$page]);
});
Route::redirect('/list', '/list/0');

Route::post('/search', function(Request $req) {
	$search = $req->input('data');
	$MAX_PER_PAGE = env('MAX_PER_PAGE');
	$data = DB::table('notes')->where('title', 'like', '%'.$search.'%')->take($MAX_PER_PAGE)->get();
	for ($i=0; $i < count($data); $i++) { 
		$data[$i]->author_name = DB::table('users')->where('id', $data[$i]->author)->value('name');
	}
	return view('list', ['entries'=>$data, 'page'=>0]);
});

Route::get('/user/{id}', function(string $id) {
	$MAX_PER_PAGE = env('MAX_PER_PAGE');
	// return view('dbg_msg', ['data'=>(int)$id]);
	$data = DB::table('notes')->where('author', (int)$id)->take($MAX_PER_PAGE)->get();
	for ($i=0; $i < count($data); $i++) { 
		$data[$i]->author_name = DB::table('users')->where('id', $data[$i]->author)->value('name');
	}
	return view('list', ['entries'=>$data, 'page'=>0]);
});

Route::get('/create', function(){return view('create', ['title'=>'', 'data'=>'']);});

Route::post('/post', function(Request $req){
	if (!Auth::User()) { return view('main'); }

	$author = (int)$req->input('author');
	$author_db = DB::table('users')->where('id', $author)->value('id');
	$title = $req->input('title');
	$data = $req->input('data');
	if (strlen($data) > 65536){
		return view('create', ['title'=>$title, 'data'=>$data, 'err'=>'Text could not be longer then 65536 characters']);
	}
	if (strlen($title) > 64){
		return view('create', ['title'=>$title, 'data'=>$data, 'err'=>'Title could not be longer then 64 characters']);
	}
	DB::table('notes')->insert([
		'author'=>Auth::User()->id,
		'title'=>$title,
		'data'=>$data
	]);
	$entries = DB::table('notes')->where('title', $title)->take(env('MAX_PER_PAGE'))->get();
	for ($i=0; $i < count($entries); $i++) { 
		$entries[$i]->author_name = DB::table('users')->where('id', $entries[$i]->author)->value('name');
	}
	return view('list', ['entries'=>$entries, 'page'=>0]);
});

Route::get('/edit/{id}', function(string $id){
	if (!Auth::User()) { return view('main'); }
	if (Auth::User()->id != DB::table('notes')->where('id', $id)->value('author')) { return view('main'); }
	
	$data = DB::table('notes')->where('id', $id)->first();
	// return view('dbg_msg', ['data'=>$data]);
	return view('edit', ['title'=>$data->title, 'data'=>$data->data, 'id'=>$id]);
});

Route::post('/change', function(Request $req){
	if (!Auth::User()) {return view('main');}
	if (Auth::User()->id != $req->author) {return view('main');} // wrong, need to compare author of note id, not the passed authorid, else it's crackable; do that someday and check the code for that error too

	DB::table('notes')->where('id', $req->id)->update(['data'=>$req->data, 'title'=>$req->title]);

	$entries = DB::table('notes')->where('id', $req->id)->take(env('MAX_PER_PAGE'))->get();
	for ($i=0; $i < count($entries); $i++) { 
		$entries[$i]->author_name = DB::table('users')->where('id', $entries[$i]->author)->value('name');
	}
	return view('list', ['entries'=>$entries, 'page'=>0]);
});

Route::post('/delete', function(Request $req){
	if (!Auth::User()) {return view('main');}
	if (Auth::User()->id != $req->author) {return view('main');}

	DB::table('notes')->where('id', $req->id)->delete();

	$data = DB::table('notes')->where('author', (int)$req->author)->take(env('MAX_PER_PAGE'))->get();
	for ($i=0; $i < count($data); $i++) { 
		$data[$i]->author_name = DB::table('users')->where('id', $data[$i]->author)->value('name');
	}
	return view('list', ['entries'=>$data, 'page'=>0]);
});