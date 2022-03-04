<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Transaksi extends Model
{
    protected $table = 'detail_transaksi';
    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'id_produk', 'qty', 'subtotal'];
}
