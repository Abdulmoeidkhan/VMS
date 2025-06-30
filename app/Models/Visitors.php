<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'dob' => 'date',
    // ];

    protected $fillable = [
        'uid',
        'name',
        'designation',
        'attandeeCountry',
        // 'dob',
        'attandeeCompany',
        'identity',
        'code',
        'contact',
        'email',
        // 'email',
        // 'email',
        // 'email',
        // 'email',
    ];
}
