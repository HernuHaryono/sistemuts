<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borangdosen extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'keterangan', 'deadline', 'aksi'];
    //protected $table = 'awuran';


}
