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
            $table->unsignedInteger('version_id')->comment('世代ID');
            $table->unsignedInteger('type_id')->comment('タイプID');
            $table->string('name')->comment('タイプ名');
            $table->json('weak_types')->comment('ばつぐん一覧');
            $table->json('resist_types')->comment('いまひとつ一覧');
            $table->json('invalid_types')->comment('こうかなし一覧');
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
