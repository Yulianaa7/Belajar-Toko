<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transactionModel;
use App\detailModel;

class transactionController extends Controller
{
    public function store(Request $req){
        $data=array(
            'tgl_transaksi' => date('Y-m-d'),
            'grandtotal' => 0
        );
        $proses = transactionModel::create($data);
        if($proses){
            $id_transaksi = $proses->id_transaksi;
            $grandtotal=0;
            foreach ($req->get('datapost') as $gdata) {
                $insert_detail = detailModel::create([
                    'id_transaksi' => $id_transaksi,
                    'id_produk' => $gdata['id_produk'],
                    'qty' => $gdata['quantity']
                ]);
                $grandtotal+=$gdata['harga']*$gdata['quantity'];
            }
            $updatetransaksi=transactionModel::where('id_transaksi', $id_transaksi)->update([
                'grandtotal' => $grandtotal,
            ]);
            return response()->json(['status' => true, 'message' => 'sukses menyimpan kedalam database']);
        }else{
            return response()->json(['status' => false, 'message' => 'gagal menyimpan kedalam database']);
        }
    }
}
