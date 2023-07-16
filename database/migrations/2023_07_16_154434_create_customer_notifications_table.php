<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('title')->nullable();
            $table->string('body')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_read')->default(false);
            $table->boolean('is_received')->default(false);
            $table->string('meta_data_id')->nullable();
            $table->text('meta_data')->nullable();
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
        Schema::dropIfExists('customer_notifications');
    }
};
