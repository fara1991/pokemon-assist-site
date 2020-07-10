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
            $table->integer('version_id')->unsigned()->comment('世代ID');
            $table->integer('skill_id')->unsigned()->comment('技ID');
            $table->integer('type_id')->unsigned()->comment('タイプID');
            $table->integer('power')->comment('威力');
            $table->integer('power_point')->comment('PP');
            $table->integer('hit_rate')->comment('命中率');
            $table->boolean('is_direct')->comment('接触技かどうか');
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
