<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    protected $table = "doctors";
    protected $dates = ["dob"];
    protected $fillable = [
        "name",
        "mname",
        "lname",
        "dob",
        "gender",
        "phone",
        "email",
        "city",
        "address",
        "department_id",
    ];
}
