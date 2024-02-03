<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NidSearched extends Model
{
    use HasFactory;

    protected $table = 'nid_searched';

    protected $fillable = [
        'nidno',
        'dob',
        'name_bn',
        'name_en',
        'father_name',
        'mother_name',
        'old_nid',
        'blood_group',
        'present_address',
        'userid',
        'search_date',
        'photo',
    ];
}
