<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToNidSearched extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nid_searched', function (Blueprint $table) {
            $table->string('oldNationalIdNumber')->nullable();
            $table->string('spouseNameBN')->nullable();
            $table->string('gender')->nullable();
            $table->string('profession')->nullable();
            $table->string('disability')->nullable();
            $table->string('Disability_other')->nullable();
            $table->string('presentDivision')->nullable();
            $table->string('presentDistrict')->nullable();
            $table->string('present_rmo')->nullable();
            $table->string('present_city')->nullable();
            $table->string('presentThana')->nullable();
            $table->string('presentUnion')->nullable();
            $table->string('present_mouza')->nullable();
            $table->string('present_additional_mouza')->nullable();
            $table->string('presentPost')->nullable();
            $table->string('presentPostCode')->nullable();
            $table->string('present_region')->nullable();
            $table->string('permanentDivision')->nullable();
            $table->string('permanentDistrict')->nullable();
            $table->string('permanent_rmo')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanentThana')->nullable();
            $table->string('permanentUnion')->nullable();
            $table->string('permanent_mouza')->nullable();
            $table->string('permanent_additional_mouza')->nullable();
            $table->string('permanentPost')->nullable();
            $table->string('permanentPostCode')->nullable();
            $table->string('permanent_region')->nullable();
            $table->string('identification')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('religion')->nullable();
            $table->string('no_finger')->nullable();
            $table->string('no_finger_print')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nid_searched', function (Blueprint $table) {
            $table->dropColumn([
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
            ]);
        });
    }
}
