<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use Session;

class AjaxController extends Controller
{
    public function getDistrict($province_id)
    {
    	//echo 1; exit;
    	$districts = District::where('province_id', $province_id)->get();
    	//printf($districts);
        if (Session::has('user')) 
        {
            echo "<option value='" . Session('user')->district_id ."'>". Session('user')->district->name . "</option>";
        }
    	foreach ($districts as $item) 
    	{
            if (Session::has('user')) {
                if(Session('user')->district_id == $item->id)
                {
                    continue;
                }
            }
    		echo "<option value='" . $item->id ."'>". $item->name . "</option>";    	
        }
    }
}
