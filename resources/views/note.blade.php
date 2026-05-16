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
		@include('header')
		<a class="border p-1 text-xl">{{$title}}</a> <br/>
		<a class='text-xs'>by </a><a href='/user/{{ $author_id }}' class='text-[#411cc5] underline'>{{ $author }}</a>
		@if (Auth::user() && Auth::user()->id == $author_id)
			<a>  (you) </a><a class="text-[#411cc5] underline" href="/edit/{{ $id }}">Edit</a>
		@endif

		<div class="w-full border p-2 mt-2">
			<a class="wrap-break-word">
				{{ $data }}
			</a>
		</div>
		@include('footer')
	</body>
</html>
