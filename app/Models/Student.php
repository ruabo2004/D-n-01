<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = 'student';


    protected $fillable = [
        'name',
        'email',
        'date_of_birth'
    ];


    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
