<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mytime = Carbon\Carbon::now();
        
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->text('order_status');
            $table->timestamps();
        });

        DB::table('statuses')->insert(
            array(
                array("id"=>'1',"order_status"=>"العباسية" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'2',"order_status"=>"القولد بحري" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'3',"order_status"=>"شبعانة بحري" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'4',"order_status"=>"شبعانة قبلي" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'5',"order_status"=>"سلقي" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'6',"order_status"=>"تمبو" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'7',"order_status"=>"شبتوت" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'8',"order_status"=>"الخندق" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'9',"order_status"=>"سالي" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'10',"order_status"=>"سوري" , "created_at" => $mytime->toDateTimeString()),
               
            )
        );

        Schema::rename('statuses', 'order_statuses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
