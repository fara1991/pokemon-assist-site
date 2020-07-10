<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_types', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment('ID');
            $table->integer('version_id')->unsigned()->comment('世代ID');
            $table->integer('type_id')->unsigned()->comment('タイプID');
            $table->string('name')->comment('タイプ名');
//            $table->json('effective_types')->comment('相性一覧');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_types');
    }
}
