<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPersonalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_personalities', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment('ID');
            $table->unsignedInteger('version_id')->comment('世代ID');
            $table->unsignedInteger('personal_id')->comment('性格ID');
            $table->string('name')->comment('性格名');
            $table->json('status_magnifications')->comment('性格補正');
            $table->string('like_taste')->comment('好みの味');
            $table->string('dislike_taste')->comment('嫌いな味');
            $table->string('description')->comment('補正説明');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_personalities');
    }
}
