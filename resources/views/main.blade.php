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
		<a class="font-[Consolas] min-w-max text-center flex text-3xl p-12 pt-24 pb-24 bg-white shadow-sm rounded-lg mb-5">Lorem ipsum</a>
		<div class="justify-end flex font-[Consolas] min-w-max text-center text-3xl p-12 pt-24 pb-24 bg-white shadow-sm rounded-lg mb-5">
			<a>dolor sit amet</a>
		</div>
		<a class="font-[Consolas] min-w-max text-center flex text-3xl p-12 pt-24 pb-24 bg-white shadow-sm rounded-lg mb-5">consectetur adipiscing elit</a>

		@include('footer')
	</body>
</html>
