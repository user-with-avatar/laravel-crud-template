<button class="flex w-full border-b border-[#612a2a] pt-1 bg-[#ffffff] hover:bg-[#f0f0f0] active:bg-[#e0e0e0]" onclick="{window.location.href = `/note/{{{$id}}}`}">
	<a class="ml-1 mr-5 text-nowrap text-[#411cc5] underline" href="/user/{{ $author_id }}">{{ $author_name }}</a>
	<a class="ml-1 mr-5 text-nowrap">{{ $title }}</a>
	<a class="overflow-hidden text-nowrap text-ellipsis">{{ $text }}</a>
</button>