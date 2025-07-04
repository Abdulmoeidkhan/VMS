<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GovernmentStaff extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
    ];

    protected $fillable = [
        'name',
        'ranks_uid',
        'designation',
        'identity',
        'address',
        'contact',
        'invited_by',
        'staff_category',
        'country',
        'city',
        'car_sticker_color',
        'car_sticker_no',
        'invitaion_no',
    ];

    // Optionally, generate UUID automatically when creating a company
    protected static function booted()
    {
        static::creating(function ($govtStaff) {
            $govtStaff->uid = (string) Str::uuid(); // Generate a UUID
        });

        static::creating(function ($govtStaff) {
            $govtStaff->code = 'GVST' . str_pad(mt_rand(0, 99999999), 6, '0', STR_PAD_LEFT);
        });
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'ranks_uid', 'ranks_uid');
    }

    public function invited_by()
    {
        return $this->belongsTo(Invitees::class, 'invited_by', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function staff_category()
    {
        return $this->belongsTo(StaffCategory::class, 'staff_category', 'id');
    }
}
