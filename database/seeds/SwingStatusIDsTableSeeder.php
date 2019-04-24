<?php

use Illuminate\Database\Seeder;

class SwingStatusIDsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $swingIdData = [
            '0' =>  'New',
            '1' =>  'Assigned',
            '2' =>  'Accepted',
            '3' =>  'Analyzed',
            '4' =>  'Rejected',
            '5' =>  'Unbilled',
        ];
        foreach ($swingIdData as $swingId => $swingDes) {
            DB::table('SwingStatusIDs')->insert([
                'SwingStatusID'          => $swingId,
                'Description'            => $swingDes,
            ]);
        }
    }
}
