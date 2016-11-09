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

        $this->command->info(" create Files loading ... ");
        $this->call(FilesTableSeeder::class);

        $this->command->info(" create Demands loading ... ");
        $this->call(DemandsTableSeeder::class);

        $this->command->info(" create Browses loading ... ");
        $this->call(BrowsesTableSeeder::class);

        $this->command->info(" create Tags loading ... ");
        $this->call(TagsTableSeeder::class);

        $this->command->info(" create Discuss loading ... ");
        $this->call(DiscussTableSeeder::class);

        $this->command->info(" create TagUsers loading ... ");
        $this->call(TagUsersTableSeeder::class);

        $this->command->info(" create Follows loading ... ");
        $this->call(FollowsTableSeeder::class);

        Model::reguard();
    }
}
