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
		<form action="/change" method='POST'>
			@csrf
			<input type="hidden" name="author" value="{{ Auth::User()->id }}"></input>
			<input type="hidden" name="id" value="{{ $id }}"></input>
			<textarea name="title" class="w-full h-11 border p-2 resize-none field-sizing-content" placeholder="Title">{{ $title }}</textarea>
			<textarea name="data" class="w-full h-fit border p-2 resize-none field-sizing-content" placeholder="Body">{{ $data }}</textarea>
			<div class="flex justify-between">
				<button class="border p-3 pl-5 pr-5 hover:bg-[#f0f0f0] active:bg-[#e0e0e0]">Post</button>
			</div>
		</form>
		<form action='/delete' method="POST" class="flex justify-end">
			<input type="hidden" name="author" value="{{ Auth::User()->id }}"></input>
			<input type="hidden" name="id" value="{{ $id }}"></input>
			<button class="border p-3 pl-5 pr-5 hover:bg-[#ff5454] active:bg-[#e0e0e0] transition">Delete</button>
		</form>
		@include('footer')
	</body>
</html>
