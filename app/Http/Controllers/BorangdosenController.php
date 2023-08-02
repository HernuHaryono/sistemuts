<?php

namespace App\Http\Controllers;

use App\Models\Borangdosen;
use Illuminate\Database\Seeder;
use App\Models\borangdosens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorangdosenController extends Controller
{
    //
    public function index()
    { {
            $users = DB::select('select * from sistemuts');
            return view('borangdosens', ['users' => $users]);
        }
    }

    public function insertdata(Request $request)
    {
        //dd($request->all());
        Borangdosen::create($request->all());
        return redirect()->route('home')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilkandata($id)
    {
        $data = Borangdosen::find($id);
        //dd($data);
        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Borangdosen::find($id);
        $data->update($request->all());
        return redirect()->route('home')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $data = Borangdosen::find($id);
        $data->delete();
        return redirect()->route('home')->with('success', 'Data Berhasil Dihapus');
    }
}
