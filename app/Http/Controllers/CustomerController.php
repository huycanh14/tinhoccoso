<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\District;
use App\Province;

class CustomerController extends Controller
{
    public function index()
    {
    	return view('admin.customer.index');
    }
}
