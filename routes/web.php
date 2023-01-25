<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Features;
use App\Http\Controllers\RaceController;
use App\Models\Race;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $races['races'] = DB::select('select * from races order by date desc limit 5');
        return view('dashboard')->with($races);
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->get('/races', function() {
    //$races['races'] = Race::all();
    $races['races'] = DB::select('select * from races order by date desc');
    $leagues['leagues'] = DB::table('races')->distinct()->get(['league']);
    $tracks['tracks'] = DB::table('races')->distinct()->orderBy('track')->get(['track']);
    $games['games'] = DB::table('races')->distinct()->get(['game']);
    return view('races')
        ->with($races)
        ->with($leagues)
        ->with($tracks)
        ->with($games);
})->name('races');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->get('/addrace', function () {
    return view('addrace');
})->name('addrace');

Route::post('addnewrace', [RaceController::class, 'store'])->name('addnewrace')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->get('/stats', function () {
    //$wins = DB::select('select count(race_position) from races where race_position=1');
    /**$wins = DB::table('races')
            ->selectRaw('count(race_position)')
            ->where('race_position', '1')
            ->get();**/
    $wins = DB::table('races')->where('race_position', '1')->count();
    $races_started = DB::table('races')->count();
    $podiums = DB::table('races')->where('race_position', '1')->orWhere('race_position', '2')->orWhere('race_position', '3')->count();
    $top10 = DB::table('races')
            ->where('race_position', '1')
            ->orWhere('race_position', '2')
            ->orWhere('race_position', '3')
            ->orWhere('race_position', '4')
            ->orWhere('race_position', '5')
            ->orWhere('race_position', '6')
            ->orWhere('race_position', '7')
            ->orWhere('race_position', '8')
            ->orWhere('race_position', '9')
            ->orWhere('race_position', '10')
            ->count();
    $poles = DB::table('races')->where('qualifying_position', '1')->count();
    $DNFs = DB::table('races')->where('race_position', 'DNF')->count();
    $avg_race = DB::table('races')->whereNot('race_position', 'DNF')->avg('race_position');
    $avg_race = round($avg_race, 2);
    $avg_qualifying = DB::table('races')->avg('qualifying_position');
    $avg_qualifying = round($avg_qualifying, 2);
    $penalties = DB::table('races')->sum('penalties');
    // queries for bar chart
    $race2 = DB::table('races')->where('race_position', '2')->count();
    $race3 = DB::table('races')->where('race_position', '3')->count();
    $race4 = DB::table('races')->where('race_position', '4')->count();
    $race5 = DB::table('races')->where('race_position', '5')->count();
    $race6 = DB::table('races')->where('race_position', '6')->count();
    $race7 = DB::table('races')->where('race_position', '7')->count();
    $race8 = DB::table('races')->where('race_position', '8')->count();
    $race9 = DB::table('races')->where('race_position', '9')->count();
    $race10 = DB::table('races')->where('race_position', '10')->count();
    $race11 = DB::table('races')->where('race_position', '11')->count();
    $race12 = DB::table('races')->where('race_position', '12')->count();
    $race13 = DB::table('races')->where('race_position', '13')->count();
    $race14 = DB::table('races')->where('race_position', '14')->count();
    $race15 = DB::table('races')->where('race_position', '15')->count();
    $race16 = DB::table('races')->where('race_position', '16')->count();
    $race17 = DB::table('races')->where('race_position', '17')->count();
    $race18 = DB::table('races')->where('race_position', '18')->count();
    $race19 = DB::table('races')->where('race_position', '19')->count();
    $race20 = DB::table('races')->where('race_position', '20')->count();
    $quali2 = DB::table('races')->where('qualifying_position', '2')->count();
    $quali3 = DB::table('races')->where('qualifying_position', '3')->count();
    $quali4 = DB::table('races')->where('qualifying_position', '4')->count();
    $quali5 = DB::table('races')->where('qualifying_position', '5')->count();
    $quali6 = DB::table('races')->where('qualifying_position', '6')->count();
    $quali7 = DB::table('races')->where('qualifying_position', '7')->count();
    $quali8 = DB::table('races')->where('qualifying_position', '8')->count();
    $quali9 = DB::table('races')->where('qualifying_position', '9')->count();
    $quali10 = DB::table('races')->where('qualifying_position', '10')->count();
    $quali11 = DB::table('races')->where('qualifying_position', '11')->count();
    $quali12 = DB::table('races')->where('qualifying_position', '12')->count();
    $quali13 = DB::table('races')->where('qualifying_position', '13')->count();
    $quali14 = DB::table('races')->where('qualifying_position', '14')->count();
    $quali15 = DB::table('races')->where('qualifying_position', '15')->count();
    $quali16 = DB::table('races')->where('qualifying_position', '16')->count();
    $quali17 = DB::table('races')->where('qualifying_position', '17')->count();
    $quali18 = DB::table('races')->where('qualifying_position', '18')->count();
    $quali19 = DB::table('races')->where('qualifying_position', '19')->count();
    $quali20 = DB::table('races')->where('qualifying_position', '20')->count();
    return view('stats')
        ->with('wins', $wins)
        ->with('races_started', $races_started)
        ->with('podiums', $podiums)
        ->with('top10', $top10)
        ->with('poles', $poles)
        ->with('DNFs', $DNFs)
        ->with('avg_race', $avg_race)
        ->with('avg_qualifying', $avg_qualifying)
        ->with('penalties', $penalties)
        ->with('race2', $race2)
        ->with('race3', $race3)
        ->with('race4', $race4)
        ->with('race5', $race5)
        ->with('race6', $race6)
        ->with('race7', $race7)
        ->with('race8', $race8)
        ->with('race9', $race9)
        ->with('race10', $race10)
        ->with('race11', $race11)
        ->with('race12', $race12)
        ->with('race13', $race13)
        ->with('race14', $race14)
        ->with('race15', $race15)
        ->with('race16', $race16)
        ->with('race17', $race17)
        ->with('race18', $race18)
        ->with('race19', $race19)
        ->with('race20', $race20)
        ->with('quali2', $quali2)
        ->with('quali3', $quali3)
        ->with('quali4', $quali4)
        ->with('quali5', $quali5)
        ->with('quali6', $quali6)
        ->with('quali7', $quali7)
        ->with('quali8', $quali8)
        ->with('quali9', $quali9)
        ->with('quali10', $quali10)
        ->with('quali11', $quali11)
        ->with('quali12', $quali12)
        ->with('quali13', $quali13)
        ->with('quali14', $quali14)
        ->with('quali15', $quali15)
        ->with('quali16', $quali16)
        ->with('quali17', $quali17)
        ->with('quali18', $quali18)
        ->with('quali19', $quali19)
        ->with('quali20', $quali20);
})->name('stats');
