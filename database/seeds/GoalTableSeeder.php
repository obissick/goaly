<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GoalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 50) as $index)
        {


            $start_date = '2018-04-31 00:00:00';
            $end_date = '2018-12-31 00:00:00';

            $min = strtotime($start_date);
            $max = strtotime($end_date);

            // Generate random number using above bounds
            $val = rand($min, $max);
            $weeks = rand(1, 52);
            $user = rand(1, 3);
            // Convert back to desired date format
            $start = new DateTime(date('Y-m-d H:i:s', $val));
            $end = $start->modify('+' . $weeks . ' weeks');

            DB::table('goals')->insert([
                'title' => str_random(10),
                'content' => str_random(1000),
                'target_date' => $start,
                'is_private' => 0,
                'user_id' => $user,
            ]);
        }
    }
}
