<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDeliveryTimeToString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mytime = Carbon\Carbon::now();
        Schema::table('delivery_times', function (Blueprint $table) {
            $table->string('delivery_time')->nullable()->change();
        });

        DB::table('delivery_times')->insert(
            array(
                array("id"=>'1',"delivery_time"=>"from day 1 to day 10" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'2',"delivery_time"=>"from day 11 to day 20" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'3',"delivery_time"=>"from day 21 to day 30" , "created_at" => $mytime->toDateTimeString()),
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
        Schema::table('delivery_times', function (Blueprint $table) {
            //
        });
    }
}
