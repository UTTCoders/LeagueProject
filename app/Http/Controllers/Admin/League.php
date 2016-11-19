<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\League\Stadium;
use Validator;
use Storage;

class League extends Controller
{
    //
    public function getStadiums(Request $request){
        return Stadium::all();
    }
    public function addStadium(Request $request)
    {
        $result = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'required',
            'location' => 'required'
        ]);
        if($result->fails()){
            return [
                'msgs' => ['title' => 'Error' ,'type' => 'error-card' ,'content' => [$result->messages()->all()]],
                'stadium' => null
            ];
        }
        $loc = json_decode($request->location);
        if(Stadium::where('location->lat','=',$loc->lat)
          ->where('location->lng','=',$loc->lng)
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
            'location' => json_encode($loc)
        ]);
        
        return [
            'msgs' => ['title' => 'Good done!' ,'type' => 'success-card' ,'content' => ['Success!']],
            'stadium' => $stadium
        ];
    }
}
