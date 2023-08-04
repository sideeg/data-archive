<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mytime = Carbon\Carbon::now();
        
        Schema::create('medication_status', function (Blueprint $table) {
            $table->id();
            $table->text('medication_status');
            $table->timestamps();
        });

        DB::table('medication_status')->insert(
            array(
                array("id"=>'1',"medication_status"=>"new" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'2',"medication_status"=>"the medicine was received" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'3',"medication_status"=>"transferred to stock" , "created_at" => $mytime->toDateTimeString()),
                array("id"=>'4',"medication_status"=>"delivered to the customer" , "created_at" => $mytime->toDateTimeString()),
            )
        );

        Schema::rename('medication_status', 'medication_statuses');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medication_status');
    }
}
