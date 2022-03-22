<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_instances', function (Blueprint $table) {
            $table->id();
            $table->date('instance_date');
            $table->string('instance_number');
            $table->text('notes');
            $table->foreignId('checklist_id')->references('id')->on('checklists');
            $table->foreignId('employee')->references('id')->on('users');
            $table->foreignId('supervisor')->references('id')->on('users');
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
        Schema::dropIfExists('checklist_instances');
    }
}
