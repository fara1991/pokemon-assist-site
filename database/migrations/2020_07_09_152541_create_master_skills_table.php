<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_skills', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment('ID');
            $table->unsignedInteger('version_id')->comment('世代ID');
            $table->unsignedInteger('skill_id')->comment('技ID');
            $table->string('name')->comment('技名');
            $table->unsignedInteger('type_id')->comment('タイプID');
            $table->string('power')->comment('威力');
            $table->unsignedInteger('power_point')->comment('PP');
            $table->string('hit_rate')->comment('命中率');
            $table->boolean('is_direct')->comment('接触技かどうか');
            $table->integer('priority')->comment('優先度');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_skills');
    }
}
