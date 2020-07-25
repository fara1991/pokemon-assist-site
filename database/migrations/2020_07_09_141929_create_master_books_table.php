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
            $table->unsignedInteger('version_id')->comment('世代ID');
            $table->unsignedInteger('book_id')->comment('図鑑ID');
            $table->string('book_name')->comment('図鑑名');
            $table->unsignedInteger('book_no')->comment('図鑑番号');
            $table->string('pokemon_name')->comment('ポケモンの名前');
            $table->string('pokemon_region_name')->comment('ポケモン別フォーム名');
            $table->unsignedInteger('region_id')->comment('リージョンID');
            $table->string('region')->comment('リージョン名');
            $table->json('skill_ids')->comment('技一覧');
            $table->json('base_stats')->comment('種族値一覧');
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
