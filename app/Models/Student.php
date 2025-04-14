<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'email',
        'phone',
        'address',
        'reg_date',
        'parent_number',
        'parent_email',
        'dob',
        'blood_group',
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
        'reg_date' => 'datetime',
        'dob' => 'datetime',
    ];

    public function my_class(){
        return $this->belongsTo(Classes::class);
    }

    public function dorm(){
        return $this->belongsTo(Dorm::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
