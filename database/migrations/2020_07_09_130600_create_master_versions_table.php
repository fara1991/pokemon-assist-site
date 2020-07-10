<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_versions', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment('ID');
            $table->integer('version_id')->unsigned()->comment('世代ID');
            $table->string('name')->comment('タイトル名');
            $table->string('short_name')->comment('タイトル略称名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_versions');
    }
}
