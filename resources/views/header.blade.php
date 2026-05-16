@vite(['resources/css/app.css', 'resources/js/app.js'])


{{-- pb-4 pt-4 text-center w-full hover:bg-[#f0f0f0] active:bg-[#e0e0e0] border-l font-[Consolas] --}}
<div class="flex justify-between bg-white shadow-sm rounded-lg mb-5">
  <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/'>Main</a>
  <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/list'>Search</a>
  @if (Auth::user())
    <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/user/{{ Auth::user()->id }}'>Your Notes</a>
  @endif
  @if (Auth::user())
    <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/create'>Create</a>
  @else
    <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/register'>Create</a>
  @endif
  @if (Auth::user())
    {{-- <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center">{{ Auth::user()->name }}</a> --}}
    
    <x-dropdown class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center">
        <x-slot name="trigger" class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center">
            <button class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center">
                <div>{{ Auth::user()->name }}</div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
  @else
    <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/register'>Register</a>
    <a class="font-[Consolas] p-6 hover:bg-gray-50 grow text-center" href='/login'>Login</a>
  @endif
</div>