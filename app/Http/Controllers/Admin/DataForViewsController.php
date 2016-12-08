<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Team;
use App\League\Stadium;
use App\League\Coach;
use App\League\Season;

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
          if($month == 8 || $month == 5) break;
          if($month == 12){
            $month = 0;
            $year++;
          }
        }
        $endMonth;
        if($month == 5) $endMonth = 8;
        else $endMonth = 5;
        $month = date('F', mktime(0,0,0,$month,1,$year));
        $endMonth = date('F', mktime(0,0,0,$endMonth,1,$year+1));
        $season = ['start_date' => ['month' => $month, 'year' => $year], 'end_date' => ['month' => $endMonth, 'year' => $year+1]];
        return view('admin.calendar.seasons.add-matches',['firstSeason' => $season]);
      }
      else{
        $season = Season::latest('start_date')->get()->first();
        return view('admin.calendar.seasons.add-matches',['season' => $season]);
      }
    }
}
