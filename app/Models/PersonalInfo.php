<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable=[
        "first_name",
        "last_name",
        "email",
        "phone",
        "location",
        "marital_status",
        "gender",
        "birth_year"
    ];
}
