<?php

namespace App\Http\Controllers;

use App\Models\Borangdosen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $borang = Borangdosen::get();

        //dd($borang);
        return view('Home', compact('borang'));
    }

    public function tambahdokumen()
    {
        return view('borangdosen');
    }
}
