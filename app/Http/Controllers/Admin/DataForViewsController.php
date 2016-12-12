<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Team;
use App\League\Stadium;
use App\League\Coach;
use App\League\Season;
use App\League\Match;
use App\League\Referee;
use Carbon\Carbon;

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
      foreach ($todayMatches as $match) {
        $match->localTeam=$match->teams()->wherePivot("local",true)->first();
        $match->visitorTeam=$match->teams()->wherePivot("local",false)->first();
        if($match->state != 0){
          $match->localTeam->goalsCount=0;
          $match->visitorTeam->goalsCount=0;
          foreach ($match->goals as $goal) {
            if($goal->player->team->id == $match->localTeam->id)
              $match->localTeam->goalsCount++;
            else $match->visitorTeam->goalsCount++;
          }
        }
      }
      $tomorrowMatches = Match::whereDay('start_date',date('d')+1)->whereMonth('start_date',date('m'))->whereYear('start_date',date('Y'))->get();
      $pendingTasks=[];
      if(Team::count() < 20)
        $pendingTasks[]=[
          'msg' => "The league has ".Team::count()."/20 teams .It must have 20.",
          'link' => '/admin/teams/add'
        ];
      $withoutStadiumCount=Team::whereNull('stadium_id')->count();
      if($withoutStadiumCount > 0)
        $pendingTasks[]=[
          'msg' => "The league has ".$withoutStadiumCount."teams without stadium.",
          'link' => '/admin/teams/edit'
        ];
      $withoutCoachCount=Team::whereNull('coach_id')->count();
      if($withoutCoachCount > 0)
        $pendingTasks[]=[
          'msg' => "The league has ".$withoutCoachCount."teams without coach.",
          'link' => '/admin/teams/edit'
        ];
      $nonCompleteTeams="";
      $teams=Team::get();
      foreach ($teams as $i => $team) {
        if($team->players->count() < 18){
          if($i == count($teams)-1)
            $nonCompleteTeams .= $team->name.".";
          else $nonCompleteTeams .= $team->name.", ";
        }
      }
      if($nonCompleteTeams != "")
        $pendingTasks[]=[
          'msg' => "The next teams have less of 18 players: ".$nonCompleteTeams,
          'link' => '/admin/players/add'
        ];
      if(Referee::count() < 20)
        $pendingTasks[]=[
          'msg' => "The league must have 20 referees.",
          'link' => '/admin/referees/add'
        ];
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
        $pendingTasks[]=[
          'msg' => "You have not programmed the next season (".date('F Y',mktime(0,0,0,$month,1,$year))." - ".date('F Y',mktime(0,0,0,5,1,$year+1)).").",
          'link' => '/admin/seasons/add-matches'
        ];
      }
      else{
        $lastSeason = Season::latest('start_date')->first();
        if(!$lastSeason->end_date)
        $pendingTasks[]=[
          'msg' => "The next season is incomplete (".$lastSeason->matches->count()."/"."380 matches).",
          'link' => '/admin/seasons/add-matches'
        ];
        else if(date('Y-m-d') > $lastSeason->end_date){
          $pendingTasks[]=[
            'msg' => "You have not programmed the next season (".date('F Y',mktime(0,0,0,8,1,date('Y',strtotime($lastSeason->end_date))))." - ".date('F Y',mktime(0,0,0,5,1,date('Y',strtotime($lastSeason->end_date))+1)).").",
            'link' => '/admin/seasons/add-matches'
          ];
        }
      }
      return view('admin.calendar.seasons.control-matches',[
        'todayMatches' => $todayMatches,
        'tomorrowMatches' => $tomorrowMatches,
        'states' => ['uncoming','first half','second half','full time'],
        'pendingTasks' => $pendingTasks
      ]);
    }

    public function getMatch(Request $request, $id){
      $match=Match::find($id);
      if(!$match) return redirect('/');
      if(date('Y-m-d H:i:s') < Carbon::parse($match->start_date)->subHours(3)->toDateTimeString())
        return redirect('/admin/seasons/control-matches')
                        ->with('msg',['title' => 'Ups!', 'content' => "Wait ultil the match get closer. Max 3 hours before."]);
      $match->localTeam=$match->teams()->wherePivot("local",true)->first();
      $match->visitorTeam=$match->teams()->wherePivot("local",false)->first();
      return view('admin.calendar.seasons.match-narrating',[
        'states' => ['uncoming','first half','second half','full time'],
        'match' => $match
      ]);
    }
}
