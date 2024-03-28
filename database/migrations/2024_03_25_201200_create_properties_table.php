<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->string('code');
        $table->string('type_property');
        $table->decimal('max_price', 10, 2);
        $table->decimal('min_price', 10, 2)->nullable();
        $table->string('title');
        $table->text('description');
        $table->integer('bedroom')->nullable();
        $table->integer('bathroom')->nullable();
        $table->integer('garage')->nullable();
        $table->decimal('construction_area', 10, 2)->nullable();
        $table->string('state_province');
        $table->string('sector')->nullable();
        $table->string('city');
        $table->boolean('is_negotiable')->default(false);
        $table->string('slug')->unique();
        $table->text('address')->nullable();
        $table->double('lat', 15, 10)->nullable();
        $table->double('lng', 15, 10)->nullable();
        $table->string('laundry_type')->nullable();
        $table->boolean('is_active')->default(false);
        $table->unsignedBigInteger('user_id'); // Asegúrate de que el tipo de dato coincida con tu columna de ID de usuarios.
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('properties');
    }
}
