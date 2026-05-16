@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- <div class="flex justify-between bg-white shadow-sm rounded-lg mb-5 h-100 w-100">
  <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/'>This</a>
  <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/list'>Is</a>
  <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/note'>Foo</a>
  <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/create'>Ter</a>
</div> --}}

<div class="bg-white h-40 p-4 rounded-md flex justify-between font-[Consolas] mt-20 flex-1 shadow-sm">
  <div class="text-[20px]">
    <a>Huge text on the topleft</a><br/>
    <a>the second line</a>
  </div>
  <div class="grid items-end">
    <div>
      <a>Text on the bottomright</a><br/>
      <a>and maybe some phone number: 8 (800) 555 35 35</a><br/>
      <a href="/" class="text-[#411cc5] underline">and a link</a><br/>
    </div>
  </div>
</div>