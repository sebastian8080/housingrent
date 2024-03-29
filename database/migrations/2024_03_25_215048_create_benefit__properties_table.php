<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_benefit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domain_id');
            $table->unsignedBigInteger('benefit_id');
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
            $table->foreign('benefit_id')->references('id')->on('benefits')->onDelete('cascade');
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
        Schema::dropIfExists('benefit__properties');
    }
}
