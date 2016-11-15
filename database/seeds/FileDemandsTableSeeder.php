<?php

use Illuminate\Database\Seeder;

class FileDemandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->default_();
    }

    public function default_()
    {
        $this->command->info(" create file_demands loading ... ");
        $demands = \App\Models\Demand::where("state",0)->get()->pluck("id");
        $files = \App\Models\File::where("state",0)->get()->pluck("id");
        foreach ($demands as $id) {
            $fileA = array_rand($files->toArray(),6);
            foreach ($fileA as $file_id) {
                \App\Models\FileDemand::firstOrCreate([
                    "demand_id"     => $id,
                    "file_id"        => $files->toArray()[$file_id],
                ]);
            }
        }
    }
}
