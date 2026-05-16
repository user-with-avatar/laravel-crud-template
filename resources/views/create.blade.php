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
		@isset($err)
			<div id="erroroutput">
				<a class="text-white p-1 rounded-sm bg-red-400">{{ $err }}</a>
				<button onclick="{CloseError()}" class="text-white bg-red-400 p-0.5 w-6 rounded-sm">X</button>
				<br></br>
			</div>
		@endisset
		<form action="/post" method='POST'>
			@csrf
			<script>
				window.onload = ()=>{
					document.getElementById('titlecount').innerHTML = document.getElementById('title').value.length + ' / 64'
					if (document.getElementById('title').value.length > 64) {
						document.getElementById('titlecount').className = 'text-red-500'
					} else {
						document.getElementById('titlecount').className = ''
					}
					document.getElementById('datacount').innerHTML = document.getElementById('data').value.length + ' / 65535'
					if (document.getElementById('data').value.length > 64) {
						document.getElementById('datacount').className = 'text-red-500'
					} else {
						document.getElementById('datacount').className = ''
					}

					document.getElementById('title').addEventListener('input', (e)=>{
						document.getElementById('titlecount').innerHTML = document.getElementById('title').value.length + ' / 64'
						if (document.getElementById('title').value.length > 64) {
							document.getElementById('titlecount').className = 'text-red-500'
						} else {
							document.getElementById('titlecount').className = ''
						}
					});
					document.getElementById('data').addEventListener('input', (e)=>{
						document.getElementById('datacount').innerHTML = document.getElementById('data').value.length + ' / 65536'
						if (document.getElementById('data').value.length > 65536) {
							document.getElementById('datacount').className = 'text-red-500'
						} else {
							document.getElementById('datacount').className = ''
						}
					});
				}
				const CloseError = ()=>{
					document.getElementById('erroroutput').remove()
				}
			</script>


			{{-- somewhy field-sizing-content does not work, so setting it by hand --}}
			<style> 
				textarea{
					field-sizing: content;
				}		
			</style>

			<meta name="author" value="{{ Auth::User()->id }}"></meta>
			<a id="titlecount">0</a>
			<textarea id="title" name="title" class="w-full h-11 border p-2 resize-none field-sizing-content mr-2" placeholder="Title">{{ $title }}</textarea>
			<a id="datacount">0</a>
			<textarea id="data" name="data" class="w-full min-h-fit border p-2 field-sizing-content mr-2 auto-expand" placeholder="Body">{{ $data }}</textarea>

			<button class="border p-3 pl-5 pr-5 hover:bg-[#f0f0f0] active:bg-[#e0e0e0]">Post</button>
		</form>
		@include('footer')
	</body>
</html>
