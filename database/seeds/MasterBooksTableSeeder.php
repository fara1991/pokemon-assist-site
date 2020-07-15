<?php

use App\Csv;
use Illuminate\Database\Seeder;

class MasterBooksTableSeeder extends Seeder
{
    private $tableName = 'master_books';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = new Csv($this->tableName);
        $csv->csvMasterInsert();
    }
}
