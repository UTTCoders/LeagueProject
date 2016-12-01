<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\League\Stadium;
use App\League\Coach;
use Validator;
use Storage;
use App\League\Team;
use App\League\Player;

class League extends Controller
{
    //
    public function getStadiums(Request $request){
        return Stadium::all();
    }

    public function addStadium(Request $request){
        $result = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);
        if($result->fails()){
            return [
                'msgs' => ['title' => 'Error' ,'type' => 'error-card' ,'content' => $result->messages()->all()],
                'stadium' => null
            ];
        }
        if(Stadium::where('location->lat','=',(string)$request->lat)
          ->where('location->lng','=',(string)$request->lng)
          ->get()->count() > 0 ){
              return [
                  'msgs' => ['title' => 'Error' ,'type' => 'error-card' ,'content' => ['There is already a stadium in the same point.']],
                  'stadium' => null
              ];
        }
        else if(Stadium::where('name',$request->name)->get()->count() > 0 ){
            return [
                'msgs' => ['title' => 'Error' ,'type' => 'error-card' ,'content' => ['There is already a stadium with the given name.']],
                'stadium' => null
            ];
        }

        $path = $request->file('photo')->store('img/stadiums','public');

        $stadium = Stadium::create([
            'name' => $request->name,
            'photo' => $path,
            'location' => '{"lat":"'.$request->lat.'", "lng": "'.$request->lng.'"}'
        ]);

        return [
            'msgs' => ['title' => 'Good done!' ,'type' => 'success-card' ,'content' => ['Success!']],
            'stadium' => $stadium
        ];
    }

    public function getStadiumByLocation(Request $request){
        $loc = $request->location;
        foreach (Stadium::get() as $key => $stadium) {
            if(json_decode($stadium->location)->lat == $loc['lat'] and json_decode($stadium->location)->lng == $loc['lng']){
                return ['stadium' => $stadium];
            }
        }
        return ['stadium' => null];
    }

    public function updateStadium(Request $request){
        $result = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'required',
            'location' => 'required',
            'changeLocation' => 'required',
            'id' => 'required'
        ]);
        $stadium = Stadium::find($request->id);
        if($result->fails()){
            return [
                'msgs' => ['title' => 'Error' ,'type' => 'error-card' ,'content' => $result->messages()->all()],
                'stadium' => null,
                'lastStadiumName' => $stadium->name
            ];
        }
        $changes = false;

        if($request->photo != 'undefined'){
          $stadium->photo = $request->file('photo')->store('img/stadiums','public');
          $changes = true;
        }
        if($request->changeLocation === 'true'){
          $stadium->location = $request->location;
          $changes = true;
        }
        if((strtolower($stadium->name) == strtolower($request->name) or $request->name == '') and !$changes){
          return [
              'msgs' => ['title' => 'Error' ,'type' => 'alert-card' ,'content' => ['Nothing changed.'] ],
              'stadium' => null,
              'lastStadiumName' => $stadium->name
          ];
        }
        $stadium->name = $request->name;
        if($stadium->save()){
            return [
                'msgs' => ['title' => 'OK!' ,'type' => 'success-card' ,'content' => ['Stadium updated successfully!']],
                'stadium' => $stadium
            ];
        }
        return [
            'msgs' => ['title' => 'Error' ,'type' => 'error-card' ,'content' => ['Has ben a error.']],
            'stadium' => null
        ];

    }

    public function getStadiumBiId(Request $request){
        return Stadium::find($request->id);
    }

    public function deleteStadium(Request $request){
        Stadium::find($request->id)->delete();
    }

    public function addCoach(Request $request){
        $result = Validator::make($request->all(), [
          'name' => 'required|string|min:1',
          'lastName' => 'required|string|min:1',
          'photo' => 'required'
        ]);
        if($result->fails())
            return [
                'msgs' => ['title' => 'Ups!', 'content' => $results->messages()->all(), 'type' => 'alert-card'],
                'coach' => null
            ];
        if(Coach::where('name',$request->name)->where('last_name',$request->lastName)->get()->count() > 0)
            return [
                'msgs' => ['title' => 'Ups!', 'content' => ['There is already a coach with the given names.'], 'type' => 'error-card'],
                'coach' => null
            ];
        $coach = Coach::create([
            'name' => $request->name,
            'last_name' => $request->lastName,
            'photo' => $request->file('photo')->store('img/coaches','public')
        ]);
        return [
            'msgs' => ['title' => 'OK!', 'content' => ['Successfully added!'], 'type' => 'success-card'],
            'coach' => $coach
        ];
    }

    public function updateCoachNames(Request $request){
        $result = Validator::make($request->all(),[
          'id' => 'required',
          'name' => 'required',
          'last_name' => 'required'
        ]);
        if($result->fails()) return [
          'msg' => 'Provide all the data.',
          'coach' => null,
          'coachTeam' => null
        ];
        $coach = Coach::find($request->id);
        if(!$coach) return [
          'msg' => 'Coach not found.',
          'coach' => null,
          'coachTeam' => null
        ];
        $coach->name = $request->name;
        $coach->last_name = $request->last_name;
        $coach->save();
        return [
          'msg' => 'Success!',
          'coach' => $coach,
          'coachTeam' => $coach->team
        ];
    }

    public function updateCoachPhoto(Request $request){
        $result = Validator::make($request->all(), [
          'id' => 'required',
          'photo' => 'required'
        ]);
        if($result->fails()) return [
          'msg' => 'Has been a error. Try again.',
          'photo' => null
        ];
        if(!$coach = Coach::find($request->id)) return [
          'msg' => 'Has been a error. Try again.',
          'photo' => null
        ];
        $coach->photo = $request->photo->store('img/coaches','public');
        if($coach->save()) return [
          'msg' => 'Has been a error. Try again.',
          'photo' => $coach->photo
        ];
        return [
          'msg' => 'Has been a error. Try again.',
          'photo' => null
        ];
    }

    public function deleteCoach(Request $request){
        $result = Validator::make($request->all(),[
          'id' => 'required|numeric'
        ]);
        if($result->fails()) return ['title' => 'Ups!', 'content' => 'Something went wrong!', 'type' => 'error-card'];
        Coach::find($request->id)->delete();
        return ['title' => 'Ok!', 'content' => 'Coach deleted!', 'type' => 'success-card'];
    }

    public function addTeam(Request $request){
        $result = Validator::make($request->all(),[
          'teamName' => 'required',
          'teamPhoto' => 'required',
          'teamFoundationDate' => 'required',
          'stadiumId' => 'required',
          'coachId' => 'required'
        ]);
        if($result->fails()) return back()->with('msg',['title' => 'Ups!', 'content' => 'Complete everything!' ])->withInput();
        if(!Stadium::find($request->stadiumId)) return back()->with('msg',['title' => 'Ups!', 'content' => "The stadium doesn't exist!" ])->withInput();
        if(!Coach::find($request->coachId)) return back()->with('msg',['title' => 'Ups!', 'content' => "The coach doesn't exist!", ])->withInput();
        if(Team::where('stadium_id',$request->stadiumId)->where('coach_id',$request->coachId)->first())
          return back()->with('msg',['title' => 'Ups!', 'content' => 'There is already a team with the same data.' ])->withInput();
        if(Team::where('name',$request->teamName)->first())
          return back()->with('msg',['title' => 'Ups!', 'content' => 'There is already a team with the same name.' ])->withInput();
        if(Team::count() >= 20)
          return back()->with('msg',['title' => 'Ups!', 'content' => 'The necessary number of teams has been reached' ])->withInput();
        $team = new Team;
        $team->name = $request->teamName;
        $team->logo = $request->teamPhoto->store('img/teams','public');
        $team->foundation_date = $request->teamFoundationDate;
        $team->stadium_id = $request->stadiumId;
        $team->coach_id = $request->coachId;
        if($team->save()) return back()->with('msg',['title' => 'OK!', 'content' => 'Team added successful!' ]);
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Has been an error!' ])->withInput();
    }

    public function editTeam(Request $request){
      if($request->teamId == '')
        return back()->with('msg',['title' => 'What?', 'content' => 'Select a team.' ])->withInput();
      if($request->name == '' and $request->logo == null and $request->foundationDate == ''
        and $request->stadiumId == '' and $request->coachId == ''){
          return back()->with('msg',['title' => 'What?', 'content' => 'Nothing changed.' ])->withInput();
      }
      if(!$team = Team::find($request->teamId))
        return back()->with('msg',['title' => 'Ups!', 'content' => "Team could not be found." ])->withInput();
      if($request->name != ''){
        if(Team::where('id','!=',$team->id)->where('name',$request->name)->first())
          return back()->with('msg',['title' => 'Ups!', 'content' => "There is already a team with the given name." ])->withInput();
        $team->name = $request->name;
      }
      if($request->file('logo') != null){
        $team->logo = $request->file('logo')->store('img/teams','public');
      }
      if($request->foundationDate != '')
        $team->foundation_date = $request->foundationDate;
      if($request->stadiumId != ''){
        if(Team::where('id','!=',$team->id)->where('stadium_id',$request->stadiumId)->first())
          return back()->with('msg',['title' => 'Ups!', 'content' => "The stadiums already belongs to another team." ])->withInput();
        $team->stadium_id = $request->stadiumId;
      }
      if($request->coachId != '') {
        if(Team::where('id','!=',$team->id)->where('coach_id',$request->coachId)->first())
          return back()->with('msg',['title' => 'Ups!', 'content' => "The coach already belongs to another team." ])->withInput();
        $team->coach_id = $request->coachId;
      }
      if($team->save())
        return back()->with('msg',['title' => 'OK!', 'content' => "Success!" ]);
        else return back()->with('msg',['title' => 'Ups!', 'content' => "Has been an error." ])->withInput();
    }

    public function deleteTeam(Request $request){
      $result = Validator::make($request->all(),[
        'id' => 'required',
      ]);
      if($result->fails())
        return back()->with('msg',['title' => 'Ups!', 'content' => "Something went wrong!" ]);
      if(!$team = Team::find($request->id))
        return back()->with('msg',['title' => 'Ups!', 'content' => "Team could not be found." ]);
      $team->delete();
        return back()->with('msg',['title' => 'Ok!', 'content' => "Success!" ]);
    }

    public function addPlayer(Request $request){
      $result = Validator::make($request->all(),[
        'teamId' => 'required|numeric',
        'name' => 'required',
        'photo' => 'required',
        'last_name' => 'required',
        'shirt_number' => 'required|numeric',
        'nationality' => 'required'
      ]);
      if($result->fails())
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Please, complete everything.'])->withInput();
      if(Player::where('name',$request->name)->where('last_name',$request->last_name)->where('nationality',$request->nationality)->first())
        return back()->with('msg',['title' => 'Ups!', 'content' => 'There is already a player with those names.'])->withInput();
      if(!$team = Team::find($request->teamId))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Team not found.'])->withInput();
      if($team->players()->count() >= 25)
        return back()->with('msg',['title' => 'Ups!', 'content' => 'The team has enough players. Max 25 players.'])->withInput();
      if($team->players()->where('shirt_number',$request->shirt_number)->first())
        return back()->with('msg',['title' => 'Ups!', 'content' => 'There is already a player with that number in the team.'])->withInput();
      $player = new Player;
      $player->name = $request->name;
      $player->photo = $request->photo->store('img/players','public');
      $player->last_name = $request->last_name;
      $player->nationality = $request->nationality;
      $player->shirt_number = $request->shirt_number;
      $player->team_id = $team->id;
      if($player->save())
        return back()->with('msg',['title' => 'Ok!', 'content' => 'Success!'])->withInput();
      return back()->with('msg',['title' => 'Ups!', 'content' => 'Has been an error.'])->withInput();
    }

}
