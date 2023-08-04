<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertJobsIntoJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mytime = Carbon\Carbon::now();
        Schema::table('jobs', function (Blueprint $table) {
            //
        });

        DB::table('jobs')->insert(
            array(
                array("id"=>'1',"name"=>"مدير" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'2',"name"=>"متطوع" , "created_at" => $mytime->toDateTimeString()),
                // array("id"=>'3',"name"=>"delivery supervisor" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'4',"name"=>"موظف ارشيف" , "created_at" => $mytime->toDateTimeString()),
                // array("id"=>'5',"name"=>"unclassified" , "created_at" => $mytime->toDateTimeString()),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            //
        });
    }
}
