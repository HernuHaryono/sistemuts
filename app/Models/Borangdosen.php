<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borangdosen extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama', 'keterangan', 'deadline', 'status'];

    public function documents()
    {
        return $this->hasMany(Document::class, 'borang_id', 'id');
    }

    // public function validate()
    // {
    //     return $this->hasMany(Document::class, 'borang_id', 'id');
    // }

}
