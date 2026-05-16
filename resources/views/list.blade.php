<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="m-0">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>

		<!-- Tailwind init -->
		@vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="p-6 pl-12 pr-12 bg-gray-100 text-[#181b18]">
		{{-- <meta id="csrf-token" content="{{ csrf_token() }}"> --}}
		@include('header')
		{{-- <input id="searchinput" placeholder="Search" class="border-2 border-[#4d4d4d] rounded-sm w-full p-1"> --}}
		
		<form action='/search', method='POST'>
			@csrf
			<input name='data' id="searchinput" placeholder="Search" class="border-2 border-[#4d4d4d] rounded-sm w-full p-1">
		</form>


		@foreach ($entries as $e)
			@include('searchentry', ['author_id'=>$e->author, 'author_name'=>$e->author_name, 'title'=>$e->title, 'text'=>$e->data, 'id'=>$e->id])
		@endforeach

		<div class="mt-2 mb-2">
			<a href="/list/{{ $page-3 }}" class="p-1 bg-white rounded-sm shadow-md">{{ $page-3 }}</a>
			<a href="/list/{{ $page-2 }}" class="p-1 bg-white rounded-sm shadow-md">{{ $page-2 }}</a>
			<a href="/list/{{ $page-1 }}" class="p-1 bg-white rounded-sm shadow-md">{{ $page-1 }}</a>
			<a class="text-xl                    p-1 bg-white rounded-sm shadow-md">{{ $page }}</a>
			<a href="/list/{{ $page+1 }}" class="p-1 bg-white rounded-sm shadow-md">{{ $page+1 }}</a>
			<a href="/list/{{ $page+2 }}" class="p-1 bg-white rounded-sm shadow-md">{{ $page+2 }}</a>
			<a href="/list/{{ $page+3 }}" class="p-1 bg-white rounded-sm shadow-md">{{ $page+3 }}</a>
		</div>

		@include('footer')
	</body>
</html>
