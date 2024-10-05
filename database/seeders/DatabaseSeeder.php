<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'menunggu persetujuan'],
            ['name' => 'disetujui']
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
