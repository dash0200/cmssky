<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctors extends Model
{
    use HasFactory;use SoftDeletes;

    protected $table = "doctors";
    protected $dates = ["dob", "deleted_at"];
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

    public function department() {
        return $this->hasOne(Departments::class, 'id', 'department_id');
    }
}
