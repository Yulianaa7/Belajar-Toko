<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailModel extends Model
{
    protected $table = 'detail_transaction';
    protected $primaryKey = 'id_detail_transaksi';
    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'id_produk', 'qty'];
}
