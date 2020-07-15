<?php

use App\Csv;
use Illuminate\Database\Seeder;

class MasterSkillsTableSeeder extends Seeder
{
    private $tableName = 'master_skills';

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
