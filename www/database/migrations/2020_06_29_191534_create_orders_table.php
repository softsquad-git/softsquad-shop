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
            $table->integer('user_id')->nullable()->index();
            $table->decimal('total_price');
            $table->text('products_ids');
            $table->string('post_code');
            $table->string('city');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->text('additional_information')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('shipment_id')->index();
            $table->string('name');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
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
