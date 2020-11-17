<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class DummyAnnouncements extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['title'=>'Demo Event-1', 'start_date'=>'2020-09-11', 'end_date'=>'2020-09-12'],
        	['title'=>'Demo Event-2', 'start_date'=>'2020-09-11', 'end_date'=>'2020-09-13'],
        	['title'=>'Demo Event-3', 'start_date'=>'2020-10-14', 'end_date'=>'2020-10-14'],
        	['title'=>'Demo Event-3', 'start_date'=>'2020-10-17', 'end_date'=>'2020-10-18'],
        ];
        foreach ($data as $key => $value) {
        	Announcement::create($value);
        }
    }
}
