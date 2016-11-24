<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\League\Stadium;
use App\League\Coach;
use Validator;
use Storage;

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
        if($result->fails()){
            return [
                'msgs' => ['title' => 'Error' ,'type' => 'error-card' ,'content' => $result->messages()->all()],
                'stadium' => null
            ];
        }
        $stadium = Stadium::find($request->id);
        $stadium->name = $request->name;
        if($request->photo != 'undefined') $stadium->photo = $request->file('photo')->store('img/stadiums','public');
        if($request->changeLocation === 'true') $stadium->location = $request->location;
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

}
