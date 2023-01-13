<x-app-layout>
<x-slot name="header">
        <h2 class="font semibold text-xl text-gray-600 leading-tight">
            {{__('Add race') }}
    </x-slot>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ __(session('status')) }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                        @endforeach
            </ul>
        </div>
    @endif

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Add a race. Fields marked with the asterisk (*) are mandatory.</div>
        </div>
        
        <form method="POST" action="{{route('addnewrace')}}">
            @csrf
            @METHOD('POST')
            <div class="ml-12">
                <div class="mt-2 text-sm text-gray-500">
                    <div class="mt-4">
                        <!-- Check for HTML solution -->
                        <!--<x-jet-label for="league" value="* {{ __('League') }}" />
                        <x-jet-input id="league" class="block mt-1 w-full @error('league') is-invalid @enderror" type="text" name="league" value="{{old('league')}}" required /> -->
                        <label for="league" class="text-lg text-black">* League and number of the season (example: WOR S12)</label>
                        <input id="league" class="block mt-1 w-5/6 @error('league') is-invalid @enderror" type="text" name="league" value="{{old('league')}}" required />
                        @error('league')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="tier" class="text-lg text-black">* Tier</label>
                        <input id="tier" class="block mt-1 w-5/6 @error('tier') is-invalid @enderror" type="text" name="tier" value="{{old('tier')}}" required />
                        @error('tier')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="round" class="text-lg text-black">* Championship round</label>
                        <input id="round" class="block mt-1 w-5/6 @error('round') is-invalid @enderror" type="text" name="round" value="{{old('round')}}" required />
                        @error('round')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="track" class="text-lg text-black">* Track</label>
                        <input id="track" class="block mt-1 w-5/6 @error('track') is-invalid @enderror" type="text" name="track" value="{{old('track')}}" required />
                        @error('track')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="qualifying_position" class="text-lg text-black">* Qualifying position</label>
                        <input id="qualifying_position" class="block mt-1 w-5/6 @error('qualifying_position') is-invalid @enderror" type="text" name="qualifying_position" value="{{old('qualifying_position')}}" required />
                        @error('qualifying_position')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="race_position" class="text-lg text-black">* Race position</label>
                        <input id="race_position" class="block mt-1 w-5/6 @error('race_position') is-invalid @enderror" type="text" name="race_position" value="{{old('race_position')}}" required />
                        @error('race_position')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="penalties" class="text-lg text-black">* Penalties</label>
                        <input id="penalties" class="block mt-1 w-5/6 @error('penalties') is-invalid @enderror" type="text" name="penalties" value="{{old('penalties')}}" required />
                        @error('penalties')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="game" class="text-lg text-black">* Game</label>
                        <input id="game" class="block mt-1 w-5/6 @error('game') is-invalid @enderror" type="text" name="game" value="{{old('game')}}" required />
                        @error('game')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="date" class="text-lg text-black">* Date (format: month / day / year)</label>
                        <input id="date" class="block mt-1 w-5/6 @error('date') is-invalid @enderror" type="date" name="date" value="" required />
                        @error('date')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="details" class="text-lg text-black">Details</label>
                        <input id="details" class="block mt-1 w-5/6 @error('details') is-invalid @enderror" type="text" name="details" value="{{old('details')}}" />
                        @error('details')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <br>
                    <button type="submit" class="rounded-md bg-green-500 text-white hover:bg-green-600 px-4 py-2 text-sm">Save</button>
                    <a href="{{route('races')}}" type="submit" class="rounded-md bg-red-500 text-white hover:bg-red-600 px-4 py-2 ml-2 text-sm">Back</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>