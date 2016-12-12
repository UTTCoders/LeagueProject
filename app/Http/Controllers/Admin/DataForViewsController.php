<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Team;
use App\League\Stadium;
use App\League\Coach;
use App\League\Season;
use App\League\Match;

class DataForViewsController extends Controller
{
    public function getForAddTeams(Request $request){
      $freeCoaches = [];
      $freeStadiums = [];
      foreach (Stadium::get() as $stadium) {
        if(!$stadium->team){
          $freeStadiums[] = $stadium;
        }
      }
      foreach (Coach::get() as $coach) {
        if(!$coach->team){
          $freeCoaches[] = $coach;
        }
      }
      return view('admin.management.teams.add',[
        'freeCoaches' => $freeCoaches,
        'freeStadiums' => $freeStadiums,
      ]);
    }

    public function getForEditTeams(Request $request){
      $freeCoaches = [];
      $freeStadiums = [];
      foreach (Stadium::get() as $stadium) {
        if(!$stadium->team){
          $freeStadiums[] = $stadium;
        }
      }
      foreach (Coach::get() as $coach) {
        if(!$coach->team){
          $freeCoaches[] = $coach;
        }
      }
      return view('admin.management.teams.edit',[
        'freeCoaches' => $freeCoaches,
        'freeStadiums' => $freeStadiums,
      ]);
    }

    public function getForAddMatches(Request $request){
      // esta condicion no es la verdadera, pensarlo
      if(Season::count() < 1){
        $month=date('m');
        $year = date('Y');
        for($month;;$month++){
          if($month == 8) break;
          if($month == 12){
            $month = 0;
            $year++;
          }
        }
        $month = date('F', mktime(0,0,0,$month,1,$year));
        $endMonth = date('F', mktime(0,0,0,5,1,$year+1));
        $season = ['start_date' => ['month' => $month, 'year' => $year], 'end_date' => ['month' => $endMonth, 'year' => $year+1]];
        return view('admin.calendar.seasons.add-matches',['firstSeason' => $season]);
      }
      else{
        $season = Season::latest('start_date')->get()->first();
        if(!$season->end_date){
          //se esta programando una existente
          return view('admin.calendar.seasons.add-matches',['season' => $season]);
        }
        else if(date('Y-m-d') > $season->end_date){
          //se programara una nueva temporada
          $nextSeason = ['start_date'=>mktime(0,0,0,8,1,date('Y',strtotime($season->end_date))+1)];
          return view('admin.calendar.seasons.add-matches',['nextSeason' => $nextSeason]);
        }
        else{
          //season programada y en progreso
          return view('admin.calendar.seasons.add-matches',['uncomingSeason' => $season]);
        }
      }
    }

    public function getForControlMatches(Request $request){
      $todayMatches = Match::whereDay('start_date',date('d'))->whereMonth('start_date',date('m'))->whereYear('start_date',date('Y'))->get();
      $tomorrowMatches = Match::whereDay('start_date',date('d')+1)->whereMonth('start_date',date('m'))->whereYear('start_date',date('Y'))->get();
      return view('admin.calendar.seasons.control-matches',[
        'todayMatches' => $todayMatches,
        'tomorrowMatches' => $tomorrowMatches,
        'states' => ['uncoming','first half','second half','full time']
      ]);
    }
}
