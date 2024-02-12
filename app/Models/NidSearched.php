<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NidSearched extends Model
{
    use HasFactory;

    protected $table = 'nid_searched';

    protected $fillable = [
        'token',
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



       'oldNationalIdNumber',
       'spouseNameBN',
       'gender',
       'profession',
       'disability',
       'Disability_other',

       'presentDivision',
       'presentDistrict',
       'present_rmo',
       'present_city',
       'presentThana',
       'presentUnion',
       'present_mouza',
       'present_additional_mouza',
       'presentPost',
       'presentPostCode',
       'present_region',

       'permanentDivision',
       'permanentDistrict',
       'permanent_rmo',
       'permanent_city',
       'permanentThana',
       'permanentUnion',
       'permanent_mouza',
       'permanent_additional_mouza',
       'permanentPost',
       'permanentPostCode',
       'permanent_region',


       'identification',
       'phone',
       'mobile',
       'religion',
       'no_finger',
       'no_finger_print',


    ];
}
