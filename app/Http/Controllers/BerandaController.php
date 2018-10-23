<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(){
    	
    }

    public function fungsi1(){
    	$pesan = "saya belajar laravel dan ini nama fungsinya adalah fungsi 01";
    	return view('/beranda', ["pesan" => $pesan]);
    }
}
