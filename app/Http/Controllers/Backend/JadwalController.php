<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function JadwalView(){
        //$allDataUser=User::all();
        $data['allDataJadwal']=Jadwal::all();
        return view('backend.jadwal.view_jadwal', $data);
    }

    public function JadwalAdd(){
        //$allDataUser=User::all();
        //$data['allDataUser']=User::all();
        return view('backend.jadwal.add_jadwal');
    }
    
    public function JadwalStore(Request $request){

        
        $validatesData=$request->validate([
            'hari' =>'required',
            'jadwalBuka' =>'required',
            'jadwalTutup' =>'required',
        ]);
        //dd($request);
        $data=new Jadwal();
        $data->hari=$request->hari;
        $data->jadwalBuka=$request->jadwalBuka;
        $data->jadwalTutup=$request->jadwalTutup;
        $data->save();



        return redirect()->route('jadwal.view')->with('info','Tambah user berhasil');
    }

    public function JadwalEdit($id){
        //dd('berhasil masuk controller user edit');
        $editData= Jadwal::find($id);
        return view('backend.jadwal.edit_jadwal', compact('editData'));
    }

    public function JadwalUpdate(Request $request, $id){

        
        $validatesData=$request->validate([
            'hari' =>'required',
            'jadwalBuka' =>'required',
            'jadwalTutup' =>'required',
        ]);
        //dd($request);
        $data=Jadwal::find($id);
        $data->hari=$request->hari;
        $data->jadwalBuka=$request->jadwalBuka;
        $data->jadwalTutup=$request->jadwalTutup;
        
        // if($request->password!=""){
        //     $data->password=bcrypt($request->password);
        // }
        
        $data->save();



        return redirect()->route('jadwal.view')->with('info','Update barang berhasil');
    }

    public function JadwalDelete($id){
        //dd('berhasil masuk controller user edit');
        $deleteData= Jadwal::find($id);
        $deleteData->delete();


        return redirect()->route('jadwal.view')->with('info','Delete user berhasil');
    }
}
