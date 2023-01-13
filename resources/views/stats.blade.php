<style>
table, th, td {
  border: 1px solid black;
}
td {
    text-align: center;
    width: 50px;
}
.center {
  margin-left: auto;
  margin-right: auto;
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font semibold text-xl text-gray-600 leading-tight">
            {{__('Statistics') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-green-50 border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Statistics of league races
                    </div>
                </div>

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
                <div>
                    <div class="p-6">
                        <div class="ml-12">
                            <table class="center" style="width:15%">
                                    <tr><th>Races</th><td>{{ $races_started }}</td></tr>
                                    <tr><th>Wins</th><td>{{ $wins }}</td></tr>
                                    <tr><th>Podiums</th><td>{{ $podiums }}</td></tr>
                                    <tr><th>Top 10</th><td>{{ $top10 }}</td></tr>
                                    <tr><th>Pole positions</th><td>{{ $poles }}</td></tr>
                                    <tr><th>DNFs</th><td>{{ $DNFs }}</td></tr>
                                    <tr><th>Average race position</th><td>{{ $avg_race }}</td></tr>
                                    <tr><th>Average qualifying position</th><td>{{ $avg_qualifying }}</td></tr>
                                    <tr><th>Penalties (seconds)</th><td>{{ $penalties }}</td></tr>
                            </table>
                        </div>
                        <a href="{{route('dashboard')}}" type="submit" class="rounded-md bg-red-500 text-white hover:bg-red-600 px-4 py-2 ml-12 text-sm">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>