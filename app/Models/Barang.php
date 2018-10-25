<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'udated_at'];
    protected $hidden = ['_token'];
}
