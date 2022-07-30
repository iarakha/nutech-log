<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Wo;
class DashboardController extends Controller
{
    public function view()
    {

        $user = auth()->user();

        $dataMonthDone = Wo::where('status', '=', 'done')
                    ->whereMonth('created_at', Carbon::now()->month) ->count(); 

        $dataMonthOpen = Wo::where('status', '=', 'open')
                    ->whereMonth('created_at', Carbon::now()->month) ->count(); 
        
        $dataMonthProgress = Wo::where('status', '=', 'on progress')
                    ->whereMonth('created_at', Carbon::now()->month) ->count(); 
        
        $dataMonthWaiting = Wo::where('status', '=', 'waiting')
                    ->whereMonth('created_at', Carbon::now()->month) ->count(); 
        
                        
        $dataWeekDone = Wo::where('status', '=', 'done')
                ->whereBetween('created_at', [Carbon::now() -> startOfWeek(), Carbon::now() -> endOfWeek()])
                ->count();
        
        $dataWeekOpen = Wo::where('status', '=', 'open')
                ->whereBetween('created_at', [Carbon::now() -> startOfWeek(), Carbon::now() -> endOfWeek()])
                ->count();
        
        $dataWeekProgress = Wo::where('status', '=', 'on progress')
                ->whereBetween('created_at', [Carbon::now() -> startOfWeek(), Carbon::now() -> endOfWeek()])
                ->count();
                
        $dataWeekWaiting = Wo::where('status', '=', 'waiting')
                ->whereBetween('created_at', [Carbon::now() -> startOfWeek(), Carbon::now() -> endOfWeek()])
                ->count();
        
                
        $most_trouble = Wo::join('perangkat', 'wo.id_perangkat', '=', 'perangkat.id')
                ->select('perangkat.nama as name', DB::raw('COUNT(perangkat.nama) as value'))
                ->groupBy('perangkat.nama')
                ->orderBy('value', 'DESC')
                ->limit(10)
                ->get();
       
            $y = [];
                foreach($most_trouble as $item){
                    array_push($y, $item->name);
                }
                
                
           $values = [];
           foreach($most_trouble as $d){
                array_push($values, $d->value);
           }
        
        return view('pages.dashboard.view',)->withTitle('Dashboard')
        ->with([
            'role' => $user->role,

            'dataMonthDone' => $dataMonthDone,
            'dataMonthOpen' => $dataMonthOpen,
            'dataMonthProgress' => $dataMonthProgress,
            'dataMonthWaiting' => $dataMonthWaiting,

            'dataWeekDone' => $dataWeekDone,
            'dataWeekOpen' => $dataWeekOpen,
            'dataWeekProgress' => $dataWeekProgress,
            'dataWeekWaiting' => $dataWeekWaiting,
            
            'most_trouble' => $most_trouble,
            'value' => json_encode($values),
            'name' => $y,
        ],
        
        );   
    }
}

