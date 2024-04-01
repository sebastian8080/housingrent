<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre descriptivo del permiso
            $table->string('slug')->unique(); // Un identificador único para el permiso
            $table->text('description')->nullable();
            $table->string('group')->nullable();
            $table->integer('weight')->default(0);
            $table->boolean('active')->default(true);
            $table->foreignId('last_modified_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('permissions');
    }
}
