<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuRegister extends Model
{
    use HasFactory;
    protected $table = 'stu_registers';

    protected $fillable = ['fname', 'lname', 'email', 'password', 'phone', 'gender', 'dob', 'status'];
}
