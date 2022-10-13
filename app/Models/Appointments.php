<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $table  = "appointments";
    protected $dates  = ["date", "deleted_at"];
    protected $fillable = [
        "patient_id",
        "doctor_id",
        "department_id",
        "reason",
        "time_slot",
        "status",
        "cnf_time",
        "date",
        "deleted_at"
    ];

    public function getPatient() {
        return $this->hasOne(Patients::class, "id", "patient_id");
    }

    public function getDoctor() {
        return $this->hasOne(Doctors::class, "id", "doctor_id");
    }
    
    public function getDepartment() {
        return $this->hasOne(Departments::class, "id", "department_id");
    }
}
