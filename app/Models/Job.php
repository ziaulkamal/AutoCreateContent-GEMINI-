<?php

// app/Models/Job.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'jobs';

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'keyword',
        'url',
        'status',
    ];

    // Atribut yang harus disembunyikan dari array atau JSON representasi model
    protected $hidden = [];

    // Atribut yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'status' => 'boolean', // Cast kolom status menjadi boolean
    ];
}
