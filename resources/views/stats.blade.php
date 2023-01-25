<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
table, th, td {
}
td {
    text-align: center;
    width: 50px;
}
.center {
  margin-left: auto;
  margin-right: auto;
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
                            <table id="table" class="center" style="width:15%">
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
                        
                    </div>
                </div>
                <div class="p-6 sm:px-20 bg-green-50 border-b border-gray-200 text-2xl">Positions</div>
                <canvas class="p-10" id="chartBar"></canvas>
            </div>
        </div>
        <div class="mt-6">
            <a href="{{route('dashboard')}}" type="submit" class="rounded-md bg-red-500 text-white hover:bg-red-600 px-4 py-2 ml-12 text-sm">Dashboard</a>
        </div>
    </div>
    
    
<!-- Chart bar -->
<script>
  const labelsBarChart = [
    "1",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "9",
    "10",
    "11",
    "12",
    "13",
    "14",
    "15",
    "16",
    "17",
    "18",
    "19",
    "20",
    "DNF",
  ];
  const dataBarChart = {
    labels: labelsBarChart,
    datasets: [
      {
        label: "Race",
        backgroundColor: "hsl(112.4, 67.7%, 58.6%)",
        borderColor: "hsl(112.4, 67.7%, 58.6%)",
        barPercentage: '0.8',
        data: [{{$wins}}, {{$race2}}, {{$race3}}, {{$race4}}, {{$race5}}, {{$race6}}, {{$race7}}, {{$race8}}, {{$race9}}, {{$race10}}, {{$race11}}, {{$race12}}, {{$race13}}, {{$race14}}, {{$race15}}, {{$race16}},
        {{$race17}}, {{$race18}}, {{$race19}}, {{$race20}}, {{$DNFs}}],
      },
      {
        label: "Qualifying",
        backgroundColor: "hsl(112.4, 67.7%, 32.6%)",
        borderColor: "hsl(112.4, 67.7%, 32.6%)",
        barPercentage: '0.8',
        data: [{{$poles}}, {{$quali2}}, {{$quali3}}, {{$quali4}}, {{$quali5}}, {{$quali6}}, {{$quali7}}, {{$quali8}}, {{$quali9}}, {{$quali10}}, {{$quali11}}, {{$quali12}}, {{$quali13}}, {{$quali14}}, {{$quali15}},
        {{$quali16}}, {{$quali17}}, {{$quali18}}, {{$quali19}}, {{$quali20}}],
      },
    ],
  };

  const configBarChart = {
    type: "bar",
    data: dataBarChart,
    options: {},
  };

  var chartBar = new Chart(
    document.getElementById("chartBar"),
    configBarChart
  );
</script>
</x-app-layout>