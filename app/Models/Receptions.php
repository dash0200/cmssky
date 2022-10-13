<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptions extends Model
{
    use HasFactory;

    protected $table = "receptions";
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
    ];


}
