<?php

use Illuminate\Database\Seeder;
use App\Csv;

class MasterPersonalitiesTableSeeder extends Seeder
{
    private $tableName = 'master_personalities';

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
