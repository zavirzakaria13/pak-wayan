<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function AntrianView(){
        //$allDataUser=User::all();
        $data['allDataAntrian']=Antrian::all();
        return view('backend.antrian.view_antrian', $data);
    }

    public function AntrianAdd(){
        //$allDataUser=User::all();
        //$data['allDataUser']=User::all();
        return view('backend.antrian.add_antrian');
    }

    public function AntrianStore(Request $request){

        
        $validatesData=$request->validate([
            'noAntrian' =>'required',
            'namaAntrian' =>'required',
            'alamatPengantri' =>'required',
        ]);
        //dd($request);
        $data=new Antrian();
        $data->noAntrian=$request->noAntrian;
        $data->namaAntrian=$request->namaAntrian;
        $data->alamatPengantri=$request->alamatPengantri;
        $data->save();



        return redirect()->route('antrian.view')->with('info','Tambah user berhasil');
    }
}
