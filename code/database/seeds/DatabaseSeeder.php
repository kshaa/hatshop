<?php

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
        // Disable foreign key check for this connection before running seeders
        Schema::disableForeignKeyConstraints();

        $this->call(GenericRoles::class);
        $this->call(TestUsers::class);

        Schema::enableForeignKeyConstraints();
    }
}
