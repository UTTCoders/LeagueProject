<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritesController extends Controller
{
    public function AddRemove(Request $r){
    	if ($r->action) {
    		return "positive";
    	}
    	return $r->all();
    }
}
