<style>
table, th, td {
}
td {
    text-align: center
}
#table tr {
    background: #bffed6;
}
#table tr:nth-child(2n+1) {
    background: #80ffae;
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font semibold text-xl text-gray-600 leading-tight">
            {{__('Races') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-green-50 border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        League races
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
                    <div class="mt-8 ml-16 text-2xl">
                        Filter results (not yet implemented)
                    </div>
                    <form method="GET" action="#">
                        @csrf
                        @METHOD('GET')
                    <label class="ml-16">League</label>
                    <select name="league">
                        <option>All</option>
                        @foreach($leagues as $leagueModel)
                        <option value="{{$leagueModel->league}}">{{$leagueModel->league}}</option>
                        @endforeach
                    </select>
                    <label class="ml-16">Track</label>
                    <select name="track">
                        <option>All</option>
                        @foreach($tracks as $trackModel)
                        <option value="{{$trackModel->track}}">{{$trackModel->track}}</option>
                        @endforeach
                    </select>
                    <label class="ml-16">Qualifying position</label>
                    <select name="qualifying_position">
                        <option>All</option>
                        <option value="pole">Pole position</option>
                        <option value="front_row">Front row</option>
                        <option value="top5">Top 5</option>
                        <option value="top10">Top 10</option>
                        <option value="outside_top10">Outside Top 10</option>
                    </select>
                    <label class="ml-16">Race position</label>
                    <select name="race_position">
                        <option>All</option>
                        <option value="winner">Winner</option>
                        <option value="podium">Podium</option>
                        <option value="top5">Top 5</option>
                        <option value="top10">Top 10</option>
                        <option value="outside_top10">Outside Top 10</option>
                        <option value="dnf">DNF</option>
                    </select>
                    <label class="ml-16">Game</label>
                    <select name="game">
                        <option>All</option>
                        @foreach($games as $gameModel)
                        <option value="{{$gameModel->game}}">{{$gameModel->game}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-md bg-green-500 text-white hover:bg-green-600 px-4 py-2 ml-12 text-sm">Filter</button>
                    </form>
                
                    <div class="p-6">
                        <div class="ml-12">
                            <table id="table" style="width:100%">
                                <tr>
                                    <th>League</th>
                                    <th>Tier</th>
                                    <th>Round</th>
                                    <th>Track</th>
                                    <th>Qualifying position</th>
                                    <th>Race position</th>
                                    <th>Penalties</th>
                                    <th>Game</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                </tr>
                                @forelse($races as $race)
                                <tr>
                                    <td>{{$race->league}}</td>
                                    <td>{{$race->tier}}</td>
                                    <td>{{$race->round}}</td>
                                    <td>{{$race->track}}</td>
                                    <td>{{$race->qualifying_position}}</td>
                                    <td>{{$race->race_position}}</td>
                                    <td>{{$race->penalties}}</td>
                                    <td>{{$race->game}}</td>
                                    <td>{{$race->date}}</td>
                                    <td>{{$race->details}}</td>
                                </tr>
                                @empty
                                    No races added!
                                @endforelse
                            </table>
                        </div>
                    </div>
                    <form action="{{route('addrace')}}" method="GET">
                        @csrf
                        @METHOD('GET')
                        <button type="submit" class="rounded-md bg-green-500 text-white hover:bg-green-600 px-4 py-2 ml-12 text-sm">Add race</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>