<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\Goods;

class MainController extends Controller
{
    //
    public function index(){
    	$vendors = Vendor::all();
    	$goods = Goods::all();
    	return view('index', ['vendors'=>$vendors,'goods'=>$goods]);
    }
    
}
