<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->command->info(" create Users loading ... ");
        $this->call(UsersTableSeeder::class);
        $this->call(FilesTableSeeder::class);
        $this->call(DemandsTableSeeder::class);
        $this->call(BrowsesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(DiscussTableSeeder::class);
        $this->call(TagUsersTableSeeder::class);
        $this->call(FollowsTableSeeder::class);
        $this->call(TagDemandsTableSeeder::class);

        Model::reguard();
    }
}
