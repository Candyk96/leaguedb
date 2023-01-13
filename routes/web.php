<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
    return view('races')->with($races);
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
    return view('stats')
        ->with('wins', $wins)
        ->with('races_started', $races_started)
        ->with('podiums', $podiums)
        ->with('top10', $top10)
        ->with('poles', $poles)
        ->with('DNFs', $DNFs)
        ->with('avg_race', $avg_race)
        ->with('avg_qualifying', $avg_qualifying)
        ->with('penalties', $penalties);
})->name('stats');
