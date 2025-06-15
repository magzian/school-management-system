<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'email',
        'phone',
        'address',
        'hire_date',
        'department',
        'dob',
        'education',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hire_date' => 'datetime',
        'dob' => 'datetime',
    ];

    /* public function department()
    {
        return $this->belongsTo::class(Department::class);
    } */
}
