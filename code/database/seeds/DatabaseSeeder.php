<?php

use Illuminate\Database\Seeder;
use Illuminate\Validation\ValidationException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key check for this connection before running seeders
        Schema::disableForeignKeyConstraints();

        $this->call(Hats::class);
        $this->call(Charms::class);
        $this->call(Roles::class);
        $this->call(Users::class);
        $this->call(UserData::class);

        Schema::enableForeignKeyConstraints();
    }
}
