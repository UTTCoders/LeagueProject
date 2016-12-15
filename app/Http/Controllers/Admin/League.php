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
use App\League\Position;
use App\League\Referee;
use App\League\Season;
use App\League\Match;
use App\League\Event;
use App\League\Assist;
use App\League\Goal;
use Mail;
use App\Mail\MatchStarted;
use Carbon\Carbon;

class League extends Controller
{
    //
    public function getStadiums(Request $request){
        return Stadium::get();
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
        $stadium = Stadium::find($request->id);
        if(!$stadium)
          return ['result'=>false,'title' => 'Ups!', 'content' => 'Stadium not found!', 'type' => 'alert-card'];
        if($stadium->team)
          return ['result'=>false,'title' => 'Ups!', 'content' => 'The stadium belongs to a team... You cannot delete it.', 'type' => 'alert-card'];
        $stadium->delete();
        return ['result'=>true];
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
        $coach=Coach::find($request->id);
        if($coach->team)
          return ['title' => 'Ups!', 'content' => 'The coach is directing a team... You cannot delete it.', 'type' => 'error-card'];
        $coach->delete();
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
      if($team->matches->count() > 0)
        return back()->with('msg',['title' => 'Ups!', 'content' => "Team could not be deleted because is already in a competition." ]);
      if($team->players->count() > 0)
        return back()->with('msg',['title' => 'Ups!', 'content' => "Team could not be deleted because it has players registered." ]);
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
        'nationality' => 'required',
        'positions' => 'required',
        'mainPosition' => 'required'
      ]);
      if($result->fails())
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Please, complete everything.'])->withInput();
      foreach ($request->positions as $position) {
        if(!Position::find($position))
          return back()->with('msg',['title' => 'Ups!', 'content' => 'Enter a valid position.'])->withInput();
      }
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
      if($player->save()){
        foreach ($request->positions as $position) {
          if ($position == $request->mainPosition)
            $player->positions()->attach($position,['main' => true]);
          else $player->positions()->attach($position,['main' => false]);
        }
        return back()->with('msg',['title' => 'Ok!', 'content' => 'Success!']);
      }
      return back()->with('msg',['title' => 'Ups!', 'content' => 'Has been an error.'])->withInput();
    }

    public function searchPlayersByNameOrTeam(Request $request){
      $result = Validator::make($request->all(), [
        'toSearch' => 'required'
      ]);
      if($result->fails())
        return ['players' => null];
      $players = Player::havingRaw("concat(name,' ',last_name) like '%".$request->toSearch."%'")->get();
      if($players->count() > 0){
        foreach ($players as $player) {
          $player->team = $player->team;
        }
        return ['players' => $players];
      }
      if($team = Team::where('name','like','%'.$request->toSearch.'%')->first()){
        foreach ($team->players as $player) {
          $player->team = $player->team;
        }
        return ['players' => $team->players];
      }
      return ['players' => null];
    }

    public function editPlayer(Request $request){
      if(Validator::make($request->all(),[
          'playerId' => 'required'
        ])->fails()) return back()->with('msg',['title' => 'Stop just there!', 'content' => 'Select a player first.'])->withInput();
      if(!$player = Player::find($request->playerId))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Player not found.'])->withInput();
      $changed = false;
      if($request->name and strtolower($request->name) != strtolower($player->name)){
        if(Player::where('name',$request->name)->where('last_name',$player->last_name)->first())
          return back()->with('msg',['title' => 'Ups!', 'content' => 'You cannot change the name because there is a player with the same name and last name.'])->withInput();
        $player->name = $request->name;
        $changed = true;
      }
      if($request->last_name and strtolower($request->last_name) != strtolower($player->last_name)){
        if(Player::where('name',$player->name)->where('last_name',$request->last_name)->first())
          return back()->with('msg',['title' => 'Ups!', 'content' => 'You cannot change the last name because there is a player with the same name and last name.'])->withInput();
        $player->last_name = $request->last_name;
        $changed = true;
      }
      if($request->nationality){
        $player->nationality = $request->nationality;
        $changed = true;
      }
      if($request->changePositions !== null and (!$request->positions or !$request->mainPosition)){
        return back()->with('msg',['title' => 'Ups!', 'content' => 'You must select a main position and at least one position.'])->withInput();
      }
      else if($request->changePositions !== null){
        //checar si cambiaron las posiciones
        foreach ($request->positions as $pos) {
          if(!is_numeric($pos))
            return back()->with('msg',['title' => 'Ups!', 'content' => 'Has been an error with the given positions. Try again.'])->withInput();
        }
        $playerPositions=[];
        foreach ($player->positions as $position) {
          $playerPositions[]=$position->id;
        }
        $posChanged=false;
        foreach ($player->positions as $position) {
          if(!in_array($position->id,$request->positions) || ($position->pivot->main and $position->id != $request->mainPosition)){
            $changed=true;
            $posChanged=true;
          }
        }
        foreach ($request->positions as $pos) {
          if(!in_array($pos,$playerPositions))
            $changed=true;
            $posChanged=true;
        }
        if($posChanged){
          $player->positions()->detach();
          foreach ($request->positions as $position) {
            if ($position == $request->mainPosition)
              $player->positions()->attach($position,['main' => true]);
            else $player->positions()->attach($position,['main' => false]);
          }
        }
      }
      if($request->shirt_number){
        if($request->shirt_number != $player->shirt_number){
          if($request->teamId and $player->team_id != $request->teamId
            and Team::find($request->teamId)->players()->where('shirt_number',$request->shirt_number)->first()){
              return back()->with('msg',['title' => 'Ups!', 'content' => 'The shirt number has been taken.'])->withInput();
          }
          else if(!$request->teamId and $player->team){
            if($player->team->players->where('shirt_number',$request->shirt_number)->first())
              return back()->with('msg',['title' => 'Ups!', 'content' => 'The shirt number has been taken.'])->withInput();
          }
          $player->shirt_number = $request->shirt_number;
          $changed = true;
        }
      }
      if($request->teamId){
        if($player->team_id != $request->teamId){
          $player->team_id = $request->teamId;
          $changed = true;
        }
      }
      if($request->photo and $request->photo != null){
        $player->photo = $request->photo->store('img/players','public');
        $changed=true;
      }
      if($changed){
        if($player->save())
          return back()->with('msg',['title' => 'Ok!', 'content' => 'Success!']);
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Has been an error.'])->withInput();
      }
      return back()->with('msg',['title' => 'Alert!', 'content' => 'Nothing has changed!'])->withInput();
    }

    public function getPlayerPositions(Request $request){
      return Player::find($request->id)->positions;
    }

    public function getPlayersPerTeam(Request $request){
      return Team::find($request->id)->players;
    }

    public function deletePlayer(Request $request){
      $player=Player::find($request->id);
      if($player->matches->count() > 0)
        return ['title' => 'Ups!', 'content' => 'Player could not be deleted beacause he already has played in the league!', 'type' => 'success-card'];
      $player->delete();
      return ['title' => 'Ok!', 'content' => 'Player deleted!', 'type' => 'success-card'];
    }

    public function addReferee(Request $request){
      if(Validator::make($request->all(),[
        'name' => 'required',
        'last_name' => 'required',
        'photo' => 'required'
      ])->fails()){
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Complete everything!'])->withInput();
      }
      if(Referee::where('name',$request->name)->where('last_name',$request->last_name)->first())
        return back()->with('msg',['title' => 'Ups!', 'content' => 'There is already a coach with the given names!'])->withInput();
      if(Referee::count() == 20){
        return back()->with('msg',['title' => 'Ups!', 'content' => 'The league has enough referees!'])->withInput();
      }
      $referee=new Referee;
      $referee->name = $request->name;
      $referee->last_name = $request->last_name;
      $referee->photo = $request->photo->store('img/referees','public');
      if($referee->save())
        return back()->with('msg',['title' => 'OK!', 'content' => 'Coach successfully added!']);
      else return back()->with('msg',['title' => 'Ups!', 'content' => 'Has been an error.'])->withInput();
    }

    public function addMatch(Request $request){
      if(!$request->has('matchday'))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Select a matchday to insert in.'])->withInput();
      if(!$request->has('date'))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Select a valid date.'])->with('matchday',$request->matchday)->withInput();
      if(!$request->has('time'))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Select a valid time.'])->with('matchday',$request->matchday)->withInput();
      if(!$request->has('refereeId'))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Select a referee.'])->with('matchday',$request->matchday)->withInput();
      if(!$request->has('localId'))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Select the local team.'])->with('matchday',$request->matchday)->withInput();
      if(!$request->has('visitorId'))
        return back()->with('msg',['title' => 'Ups!', 'content' => 'Select the visitor team.'])->with('matchday',$request->matchday)->withInput();
      if($request->visitorId == $request->localId)
        return back()->with('msg',['title' => 'Ups!', 'content' => "The teams cannot be equal."])->with('matchday',$request->matchday)->withInput();

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
        $monthNumber=$month;
        $month = date('F', mktime(0,0,0,$month,1,$year));

        if($request->matchday > 1)
          return back()->with('matchday',$request->matchday)->with('msg',['title' => 'Ups!', 'content' => "You must programme the first matchday at the beginning."])->withInput();

        if(date('Y-m-d',strtotime($request->date)) < date('Y-m-d',strtotime('01-'.$monthNumber."-".$year))
          or date('Y-m-d',strtotime($request->date)) > date('Y-m-d',strtotime('31-'.$monthNumber."-".$year)))
          return back()->with('msg',['title' => 'Ups!', 'content' => "The league must begin on August of ".$year])
                       ->with('matchday',$request->matchday)
                       ->withInput();

          $newSeason = new Season;
          $newSeason->start_date=$request->date;
          $newSeason->save();

          $match=new Match;
          $match->start_date = $request->date." ".$request->time;
          $match->state=0;
          $match->season_id = $newSeason->id;
          $match->referee_id = $request->refereeId;
          $match->save();

          $match->teams()->attach($request->localId,['local' => true,'ball_possesion' => 0]);
          $match->teams()->attach($request->visitorId,['local' => false,'ball_possesion' => 0]);

          return back()->with('msg',['title' => 'OK!', 'content' => "Success!"]);
      }
      else{
        $season = Season::latest('start_date')->get()->first();
        if(!$season->end_date){
          if($request->date < $season->start_date || $request->date > mktime(0,0,0,5,31,date('Y',strtotime($season->start_date))+1))
              return back()->with('msg',['title' => 'Ups!', 'content' => "The match date is outside of the limits of the season."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
          if($season->matches->count() > 380)
              return back()->with('msg',['title' => 'Ups!', 'content' => "The current season is full."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
          $lastMatch = $season->matches()->latest('start_date')->get()->first();
          if($lastMatch){
            if(date('d-m-Y',strtotime($request->date)) < date('d-m-Y',strtotime($lastMatch->start_date)))
              return back()->with('msg',['title' => 'Ups!', 'content' => "The next match cannot be older than the last one."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
            if($season->matches->where('start_date',$request->date)->count() >= 10)
              return back()->with('msg',['title' => 'Ups!', 'content' => "The max number of games per day has been reached."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
            if($request->matchday > 1 and  $season->matches->count() < ($request->matchday-1)*10)
              return back()->with('msg',['title' => 'Ups!', 'content' => "Complete the last matchday."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
            if($season->matches->count() >= $request->matchday*10)
              return back()->with('msg',['title' => 'Ups!', 'content' => "The matchday is complete."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
            foreach($season->matches()->offset(($request->matchday-1)*10)->limit(10)->get() as $match){
              if($team = $match->teams()->where('id',$request->localId)->orWhere('id',$request->visitorId)->first())
                return back()->with('msg',['title' => 'Ups!', 'content' => $team->name." has already a match in the matchday ".$request->matchday."."])
                             ->with('matchday',$request->matchday)
                             ->withInput();
            }
            $referee = Referee::find($request->refereeId);
            if($season->matches()->offset(($request->matchday-1)*10)->limit(10)->where('referee_id',$request->refereeId)->first())
              return back()->with('msg',['title' => 'Ups!', 'content' => $referee->name." ".$referee->last_name." has already assigned a match in the matchday ".$request->matchday."."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
              //the next match to insert is the first of matchday
            if($request->date > date('d-m-Y',strtotime($lastMatch->start_date))){
              $lastMatchDay=date('d',strtotime($lastMatch->start_date));
              $lastMatchMonth=date('m',strtotime($lastMatch->start_date));
              $lastMatchYear=date('Y',strtotime($lastMatch->start_date));
              $tempDate=mktime(0,0,0,$lastMatchMonth,$lastMatchDay,$lastMatchYear);
              $daysCount=0;
              for (;date('d-m-Y',$tempDate) < date('d-m-Y',strtotime($request->date)) ;) {
                $daysCount++;
                $lastMatchDay++;
                if($lastMatchDay==31) {
                  $lastMatchDay=0;
                  $lastMatchMonth++;
                  if($lastMatchMonth==13){
                    $lastMatchMonth=1;
                    $lastMatchYear++;
                  }
                }
                $tempDate=mktime(0,0,0,$lastMatchMonth,$lastMatchDay,$lastMatchYear);
              }
              if($season->matches->count() == $request->matchday*10){
                if( $daysCount>15)
                  return back()->with('msg',['title' => 'Ups!', 'content' => "The max interval between matchdays are 15 days."])
                               ->with('matchday',$request->matchday)
                               ->withInput();
              }
              else{
                if($daysCount > 1)
                  return back()->with('msg',['title' => 'Ups!', 'content' => "The matches of a matchday must be continuous."])
                               ->with('matchday',$request->matchday)
                               ->withInput();
              }
            }

          }
          if($request->matchday > 1 and $season->matches->count() < 10)
            return back()->with('msg',['title' => 'Ups!', 'content' => "Complete the first matchday."])
                         ->with('matchday',$request->matchday)
                         ->withInput();

          $isSecondPart=false;
          foreach ($season->matches->chunk(190) as $i => $matches) {
            foreach ($matches as $j => $match) {
              if(!$isSecondPart){
                if($match->teams()->wherePivot('local',true)->first()->id == $request->visitorId
                  and $match->teams()->wherePivot('local',false)->first()->id == $request->localId){
                    return back()->with('msg',['title' => 'Ups!', 'content' => "The teams have already faced between them in the first part of the season."])
                                 ->with('matchday',$request->matchday)
                                 ->withInput();
                }
              }
              if(($match->teams()->wherePivot('local',true)->first()->id == $request->localId
                and $match->teams()->wherePivot('local',false)->first()->id == $request->visitorId)
                || ($match->teams()->wherePivot('local',true)->first()->id == $request->visitorId
                  and $match->teams()->wherePivot('local',false)->first()->id == $request->localId))
                return back()->with('msg',['title' => 'Ups!', 'content' => "The match is already programmed."])
                             ->with('matchday',$request->matchday)
                             ->withInput();
            }
            $isSecondPart=true;
          }

          $match=new Match;
          $match->start_date = $request->date." ".$request->time;
          $match->state=0;
          $match->season_id = $season->id;
          $match->referee_id = $request->refereeId;
          $match->save();
          /////////////////////////////////
          ////// probar esto
          /////////////////////////////////
          if($season->matches->count() == 380){
              $season->end_date=$match->start_date;
              $season->save();
          }
          $match->teams()->attach($request->localId,['local' => true,'ball_possesion' => 0]);
          $match->teams()->attach($request->visitorId,['local' => false,'ball_possesion' => 0]);
          return back()->with('msg',['title' => 'OK!', 'content' => "Success!"])
                       ->with('matchday',$request->matchday);
        }
        else if(date('Y-m-d') > $season->end_date){
          //probar este caso, cuando sigue una nueva temporada
          if(date('Y-m-d',strtotime($request->date)) < date('Y-m-d',mktime(0,0,0,8,1,date('Y',strtotime($season->end_date))+1))
            || date('Y-m-d',strtotime($request->date)) > date('Y-m-d',mktime(0,0,0,5,31,date('Y',strtotime($season->end_date))+2))){
              return back()->with('msg',['title' => 'Ups!', 'content' => "The match date is outside of the limits of the season."])
                           ->with('matchday',$request->matchday)
                           ->withInput();
          }
          if(date('Y-m-d',strtotime($request->date)) > date('Y-m-d',mktime(0,0,0,8,31,date('Y',strtotime($season->end_date))+1)))
            return back()->with('msg',['title' => 'Ups!', 'content' => "The first match must be on agust."])
                         ->with('matchday',$request->matchday)
                         ->withInput();
          $newSeason = new Season;
          $newSeason->start_date=$request->date;
          $newSeason->save();
          $match=new Match;
          $match->start_date = $request->date." ".$request->time;
          $match->state=0;
          $match->season_id = $newSeason->id;
          $match->referee_id = $request->refereeId;
          $match->save();
          $match->teams()->attach($request->localId, ['local' => true,'ball_possesion' => 0]);
          $match->teams()->attach($request->visitorId, ['local' => false,'ball_possesion' => 0]);
          return back()->with('msg',['title' => 'OK!', 'content' => "Success!"])
                       ->with('matchday',$request->matchday);
        }
        else{
          return back()->with('msg',['title' => 'Alert!', 'content' => "The season is defined and its going on. You wont be able of programme another season until the current one finish."])
                       ->with('matchday',$request->matchday)
                       ->withInput();
        }
      }

    }

    public function getMatchesPerMatchDay(Request $request){
      $matches = Season::latest('start_date')->first()->matches()->offset(($request->matchday-1)*10)->limit(10)->get();
      foreach ($matches as $match) {
        $match->teams=$match->teams;
        $match->referee=$match->referee;
      }
      return $matches;
    }

    public function startMatch(Request $request){
      if(!$request->players)
        return back()->with('msg',['title' => 'Ups!', 'content' => "Both teams must have 18 players."])
                     ->withInput();

      $match = Match::find($request->id);

      $unfixedLocalPlayers = Player::find($request->players)->where('team_id',$match->teams()->wherePivot("local",1)->first()->id);
      $unfixedVisitorPlayers = Player::find($request->players)->where('team_id',$match->teams()->wherePivot("local",0)->first()->id);

      $visitorPlayers=[];
      $localPlayers=[];
      foreach ($unfixedLocalPlayers as $player) {
        $localPlayers[]=$player;
      }
      foreach ($unfixedVisitorPlayers as $player) {
        $visitorPlayers[]=$player;
      }

      if(count($localPlayers) < 14 or count($visitorPlayers) < 14)
      return back()->with('msg',['title' => 'Ups!', 'content' => "Both teams must have at least 14 players."])
                   ->withInput();

     if(count($localPlayers) > 18 or count($visitorPlayers) > 18)
     return back()->with('msg',['title' => 'Ups!', 'content' => "Both teams cannot have more than 18 players."])
                  ->withInput();

      $match->state=1;
      $playersToAttach=[];

      for($i=0;$i<count($localPlayers);$i++){
        if($i < 11) $playersToAttach[$localPlayers[$i]->id] = ['playing' => 1,'has_left' => 0];
        else $playersToAttach[$localPlayers[$i]->id] = ['playing' => 0,'has_left' => 0];
      }
      for($i=0;$i<count($visitorPlayers);$i++){
        if($i < 11) $playersToAttach[$visitorPlayers[$i]->id] = ['playing' => 1,'has_left' => 0];
        else $playersToAttach[$visitorPlayers[$i]->id] = ['playing' => 0,'has_left' => 0];
      }

      $match->players()->attach($playersToAttach);
      $match->start_date = date('Y-m-d H:i');
      $match->save();

      $match->localTeam=$match->teams()->wherePivot("local",true)->first();
      $match->visitorTeam=$match->teams()->wherePivot("local",false)->first();

      $event = new Event;
      $event->content = "Kick off! The battle between ".$match->localTeam->name." and ".$match->visitorTeam->name." has started!";
      $event->match_id = $match->id;
      /////////////////////////////////////////// here!!!!
      ///ingresar en minutos
      //probar que se ingrese en ceros
      $event->minute = 0;
      $event->event_type_id = 7;
      $event->save();

      $followers = $match->localTeam->followers->pluck('email');
      foreach ($match->visitorTeam->followers->pluck('email') as $follower) {
        if(!in_array($follower,$followers->all()))
          $followers[] = $follower;
      }

      Mail::to($followers)->send(new MatchStarted($match));

      return back();
    }

    public function addGoal(Request $request){
      $result=Validator::make($request->all(), [
        'scorerId' =>'required',
        'matchId' =>'required|numeric'
      ]);
      if($result->fails())
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'Something went wrong!'
        ]);

      $match = Match::find($request->matchId);

      $scorerPlayer = Player::find($request->scorerId);
      $assistorPlayer = Player::find($request->assistorId);

      if($request->assistorId and $scorerPlayer->team->id != $assistorPlayer->team->id)
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'The assistor player must be of the same team than the scorer!'
        ]);

      $now = Carbon::now();
    	$matchDate = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($match->start_date)));
      $minute = $now->diffInMinutes($matchDate);

      $goal = new Goal;
      $goal->match_id = $request->matchId;
      $goal->minute = $minute;
      $goal->player_id = $request->scorerId;
      $goal->type = "regular";
      $goal->save();

      $eventDescription= "Goal of ".$scorerPlayer->name."!";

      if($request->assistorId){
        $eventDescription.=" Assistance of ".$assistorPlayer->name;
        $assist = new Assist;
        $assist->match_id = $request->matchId;
        $assist->player_id = $assistorPlayer->id;
        $assist->save();
      }

      $event = new Event;

      $event->event_type_id = 1;
      $event->content = $eventDescription;
      $event->match_id = $request->matchId;
      $event->minute = $minute;

      $event->save();

      return back()->with('msg',[
        'title' => 'OK!',
        'content' => 'Success!'
      ]);
    }

    public function addCorner(Request $request){
      if(!$request->matchId || !$request->teamId)
        return back()->with('msg',[
          'title' => 'Stop just there!',
          'content' => 'Select the team that will kick the corner.'
        ]);

      $event = new Event;

      $match = Match::find($request->matchId);

      $now = Carbon::now();
    	$matchDate = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($match->start_date)));
      $minute = $now->diffInMinutes($matchDate);

      $event->event_type_id = 3;
      $event->match_id = $match->id;
      $event->minute = $minute;
      $event->content = "Corner for ".Team::find($match->id)->name;
      $event->save();

      return back()->with('msg',[
        'title' => 'OK!',
        'content' => 'Success!.'
      ]);
    }

    public function addYellowCard(Request $request){
      if(!$match = Match::find($request->matchId)){
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'Match not found!'
        ]);
      }
      if(!$player = Player::find($request->playerId)){
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'Player not found!'
        ]);
      }
      $event = new Event;
      $event->content = "Yellow card to ".$player->name." ".$player->last_name;

      $now = Carbon::now();
    	$matchDate = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($match->start_date)));
      $minute = $now->diffInMinutes($matchDate);

      $event->minute = $minute;
      $event->event_type_id = 4;
      $event->match_id = $match->id;
      $event->save();
      return back()->with('msg',[
        'title' => 'OK!',
        'content' => 'Success!'
      ]);
    }

    public function addRedCard(Request $request){
      if(!$match = Match::find($request->matchId)){
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'Match not found!'
        ]);
      }
      if(!$player = Player::find($request->playerId)){
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'Player not found!'
        ]);
      }
      $event = new Event;
      $event->content = "Red card to ".$player->name." ".$player->last_name.". He has left the match.";

      $now = Carbon::now();
    	$matchDate = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($match->start_date)));
      $minute = $now->diffInMinutes($matchDate);

      $event->minute = $minute;
      $event->event_type_id = 5;
      $event->match_id = $match->id;

      //expulsar jugador
      $match->players()->updateExistingPivot($player->id, ['playing' => 0]);

      $event->save();

      return back()->with('msg',[
        'title' => 'OK!',
        'content' => 'Success!'
      ]);
    }

    public function addShoot(Request $request){
      if(!$match = Match::find($request->matchId)){
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'Match not found!'
        ]);
      }
      if(!$player = Player::find($request->playerId)){
        return back()->with('msg',[
          'title' => 'Ups!',
          'content' => 'Player not found!'
        ]);
      }
      $event = new Event;
      $event->content = $player->name." ".$player->last_name." has shot";

      $now = Carbon::now();
    	$matchDate = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($match->start_date)));
      $minute = $now->diffInMinutes($matchDate);

      $event->minute = $minute;
      $event->event_type_id = 6;
      $event->match_id = $match->id;

      $event->save();

      return back()->with('msg',[
        'title' => 'OK!',
        'content' => 'Success!'
      ]);
    }

    public function changeBallPossesion(Request $request){
      $match=Match::find($request->matchId);
      $match->teams()->updateExistingPivot($request->localTeamId,['ball_possesion' => $request->localTeamPosession]);
      $match->teams()->updateExistingPivot($request->visitorTeamId,['ball_possesion' => (100-$request->localTeamPosession)]);
      return back();
    }

    public function endFirstHalf(Request $request, $id){
      $match = Match::find($id);
      if(!$match) return back();
      if($match->state != 1) return back();
      $match->state = 2;
      $match->save();

      $event = new Event;
      $event->content = "End of the first half";

      $now = Carbon::now();
    	$matchDate = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($match->start_date)));
      $minute = $now->diffInMinutes($matchDate);

      $event->minute = $minute;
      $event->event_type_id = 8;
      $event->match_id = $match->id;
      $event->save();

      return back();
    }

    public function startSecondHalf(Request $request, $id){
      $match = Match::find($id);
      if(!$match) return back();
      if($match->state != 2) return back();
      $match->state = 3;
      $match->save();

      return back();
    }

    public function endMatch(Request $request, $id){

      $match = Match::find($id);
      if(!$match) return back();
      if($match->state != 3) return back();
      $match->state = 4;
      $match->save();

      $localTeam = $match->teams()->wherePivot('local',1)->first();
      $visitorTeam = $match->teams()->wherePivot('local',0)->first();

      $localTeam->goalsCount = 0;
      $visitorTeam->goalsCount = 0;
      foreach ($match->goals as $goal) {
        if($goal->player->team->id == $localTeam->id)
          $localTeam->goalsCount += 1;
        else $visitorTeam->goalsCount += 1;
      }

      $event = new Event;

      if($localTeam->goalsCount < $visitorTeam->goalsCount)
        $event->content = "Full-time! ".$visitorTeam->name." wins!";
      elseif($localTeam->goalsCount > $visitorTeam->goalsCount)
        $event->content = "Full-time! ".$localTeam->name." wins!";
      else $event->content = "Full-time! It is a draw!";

      $now = Carbon::now();
    	$matchDate = Carbon::createFromFormat('Y-m-d H:i',date('Y-m-d H:i',strtotime($match->start_date)));
      $minute = $now->diffInMinutes($matchDate);

      $event->minute = $minute;
      $event->event_type_id = 9;
      $event->match_id = $match->id;

      $event->save();

      return redirect('/');
    }
}
