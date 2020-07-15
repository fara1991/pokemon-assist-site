<?php

use App\Csv;
use Illuminate\Database\Seeder;

class MasterTypesTableSeeder extends Seeder
{
    private $tableName = 'master_types';

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
