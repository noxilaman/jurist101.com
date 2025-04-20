<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class moveCat2App extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'move:cat2app {cat_id} {app_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command move cat to new app_id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cat_id = $this->argument('cat_id');
        $app_id = $this->argument('app_id');
        $cat = \App\Models\TbLawcat::findOrFail($cat_id);
        //dd($cat);
        foreach($cat->subcats as $subcat){
            foreach($subcat->subcats as $subcat1){
                foreach($subcat1->subcats as $subcat2){
                    foreach($subcat2->subcats as $subcat3){
                        $subcat3->app_id = $app_id;
                        $subcat3->update();
                    }
                    $subcat2->app_id = $app_id;
                    $subcat2->update();
                }
                $subcat1->app_id = $app_id;
                $subcat1->update();
            }
            $subcat->app_id = $app_id;
            echo $subcat->c_name." update \n";
            $subcat->update();
        }
        $cat->app_id = $app_id;
        $cat->update();
        return Command::SUCCESS;
    }
}
