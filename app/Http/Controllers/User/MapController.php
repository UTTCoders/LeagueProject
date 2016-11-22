<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League\Stadium;

class MapController extends Controller
{
    public function getUserStadiums(){
    	return [
    		"obj"=>[
    			"location"=>[
    				"lat"=>40,
    				"lng"=>-1
    			]
    		]
    	];
    	return Stadium::all();
    }
}
