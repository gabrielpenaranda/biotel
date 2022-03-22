<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_instances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_instance_id')->references('id')->on('checklist_instances')->cascadeOnUpdate()->restrictOnDelete();
            $table->boolean('column_one')->default(false);
            $table->boolean('column_two')->default(false);
            $table->tinytext('column_three');
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
        Schema::dropIfExists('element_instances');
    }
}
