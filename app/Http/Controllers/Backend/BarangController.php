<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function BarangView(){
        //$allDataUser=User::all();
        $data['allDataBarang']=Barang::all();
        return view('backend.barang.view_barang', $data);
    }

    public function BarangAdd(){
        //$allDataUser=User::all();
        //$data['allDataUser']=User::all();
        return view('backend.barang.add_barang');
    }

    public function BarangStore(Request $request){

        
        $validatesData=$request->validate([
            'nama' =>'required',
            'jenis' =>'required',
            'tanggal' =>'required',
        ]);
        //dd($request);
        $data=new Barang();
        $data->nama=$request->nama;
        $data->jenis=$request->jenis;
        $data->tanggal=$request->tanggal;
        $data->save();



        return redirect()->route('barang.view')->with('info','Tambah barang berhasil');
    }

    public function BarangEdit($id){
        //dd('berhasil masuk controller user edit');
        $editData= Barang::find($id);
        return view('backend.barang.edit_barang', compact('editData'));
    }

    public function BarangUpdate(Request $request, $id){

        
        $validatesData=$request->validate([
            'nama' =>'required',
            'jenis' =>'required',
            'tanggal' =>'required',
        ]);
        //dd($request);
        $data=Barang::find($id);
        $data->nama=$request->nama;
        $data->jenis=$request->jenis;
        $data->tanggal=$request->tanggal;
        
        // if($request->password!=""){
        //     $data->password=bcrypt($request->password);
        // }
        
        $data->save();



        return redirect()->route('barang.view')->with('info','Update barang berhasil');
    }

    public function BarangDelete($id){
        //dd('berhasil masuk controller user edit');
        $deleteData= Barang::find($id);
        $deleteData->delete();


        return redirect()->route('barang.view')->with('info','Delete barang berhasil');
    }
}
