<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('pation_name');
            $table->bigInteger('phone');
            $table->string('prescription_photo');
            $table->string('medicine_name')->nullable();;
            $table->enum('insurance', [1, 0]);                        
            $table->string('insurance_card_photo')->nullable();
            $table->integer('order_price')->nullable();
            $table->bigInteger('user_id')->nullable();;
            $table->bigInteger('order_status_id')->nullable();
            $table->bigInteger('delivery_time_id')->nullable();
            $table->bigInteger('medication_id')->nullable();        
            $table->bigInteger('employee_id')->nullable();
            $table->timestamps();
        });

        // Schema::table('orders', function (Blueprint $table) {
        //     $table->integer('user_id')->constrained();
        //     $table->integer('order_status_id')->constrained();
        //     $table->integer('delivery_time_id')->constrained();
        //     $table->integer('medication_id')->constrained();
        
        //     $table->integer('delivery_officer_id')->constrained();
        // });
        

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}