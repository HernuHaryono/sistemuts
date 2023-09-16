<?php

namespace App\Http\Controllers;

use App\Models\Borangdosen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // $user_id = auth()->id();
        $user = auth()->user();

        if ($user->level == 'admin') {
            $borang = Borangdosen::withCount('documents')->get();
        } else {
            $borang = Borangdosen::where('user_id', $user->id)->withCount('documents')->get();
        }

        //dd($borang);
        return view('Home', compact('borang'));
    }

    public function tambahdokumen()
    {
        return view('borangdosen');
    }
}
