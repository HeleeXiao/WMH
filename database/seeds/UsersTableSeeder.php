<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(" create Users loading ... ");
        $files = \App\Models\File::where("state",0)->get()->pluck("id");
        for($i=0 ; $i<50 ; $i++)
        {
            $user = factory(\App\Models\User::class)->create();
            \App\Models\UserContent::firstOrCreate([
                'user_id' => $user->id,
                'file_id' => $files[array_rand($files->toArray())],
            ]);
            \Illuminate\Support\Facades\Event::fire(
                new \App\Events\RegisterEvent($user)
            );
            ;
        }
    }

}
