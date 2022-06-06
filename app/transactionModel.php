<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transactionModel extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = ['tgl_transaksi', 'grandtotal'];
}
