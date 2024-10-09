<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skripsi extends Model
{
    use HasFactory;

    protected $fillable = [

        'judul','nama', 'nim', 'angkatan', 'dosen_pemimbing_1','dosen_pembimbing_2'
   ];

}
