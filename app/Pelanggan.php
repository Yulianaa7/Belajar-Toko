<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//inheritance
class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    public $timestamps = false;
    //protected $primaryKey = 'id_pelanggan';
    
    protected $fillable = ['nama', 'alamat', 'telp', 'username', 'password'];
    //protected $hidden = ['password']; 
}
