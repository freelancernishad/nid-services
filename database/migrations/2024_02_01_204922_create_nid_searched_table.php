<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNidSearchedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nid_searched', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('nidno');
            $table->date('dob');
            $table->string('name_bn');
            $table->string('name_en');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('old_nid')->nullable();
            $table->string('blood_group');
            $table->text('present_address');
            $table->unsignedBigInteger('userid');
            $table->date('search_date');
            $table->string('photo')->nullable();
            $table->timestamps();

            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nid_searched');
    }
}
