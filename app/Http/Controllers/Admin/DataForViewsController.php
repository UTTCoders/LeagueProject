<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Team;
use App\League\Stadium;
use App\League\Coach;

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
}
