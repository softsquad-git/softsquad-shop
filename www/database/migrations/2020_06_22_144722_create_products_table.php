<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('title');
            $table->integer('category_id')->index();
            $table->text('description')->nullable();
            $table->text('min_description')->nullable();
            $table->dateTime('start_public_date')->nullable();
            $table->dateTime('end_public_date')->nullable();
            $table->integer('status')->default(\App\Helpers\Status::SS_PRODUCT_ACTIVE);
            $table->integer('quantity')->default(0);  #no limit
            $table->boolean('is_promo')->default(false);
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
        Schema::dropIfExists('products');
    }
}
