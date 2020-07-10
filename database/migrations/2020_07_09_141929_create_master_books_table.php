<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_books', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment('ID');
            $table->integer('version_id')->unsigned()->comment('世代ID');
            $table->integer('book_id')->unsigned()->comment('図鑑ID');
            $table->string('name')->comment('ポケモンの名前');
//            $table->json('skill_ids')->comment('技一覧');
//            $table->json('base_stats')->comment('種族値一覧');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_books');
    }
}
