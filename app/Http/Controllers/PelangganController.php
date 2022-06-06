<?php

namespace App\Http\Controllers;
use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //memvalidasi form
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; //agar password nya tidak terlihat

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

class PelangganController extends Controller
{
    //show data
    public function show(){
        return Pelanggan::all();
    }

    public function detail($id)
    {
        if(Pelanggan::where('id_pelanggan', $id)->exists()) {
            $data = DB::table('pelanggan')->where('pelanggan.id_pelanggan', '=', $id)->get();
            return Response()->json($data);
        }
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'nama' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
                'username' => 'required',
                'password' => 'required'
            ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $simpan = Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $data = Pelanggan::where('nama', '=', $request->nama)->get();

        if($simpan)
        {
            return Response()->json([
                'status' => 1,
                'message' => 'Succes create new data!',
                'data' => $data
            ]);
        }
        else
        {
            return Response()->json([
                'status' => 0,
                'message' => 'Failed create new data!',
                'data' => $data
            ]);
        }
    }

    public function update($id, Request $request){
        $validator=Validator::make($request->all(),
        [   
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        
        $ubah = Pelanggan::where('id_pelanggan', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $data = Pelanggan::where('nama', '=', $request->nama)->get();

        if($ubah) {
            return Response()->json([
                'status' => 1,
                'message' => 'Succes update data!',
                'data' => $data
            ]);
        }else{
            return Response()->json([
                'status' => 0,
                'message' => 'Failed update data!',
                'data' => $data
            ]);
        }
    }

    public function destroy($id)
    {
        $hapus = Pelanggan::where('id_pelanggan', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}
