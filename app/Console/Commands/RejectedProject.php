<?php

namespace App\Console\Commands;

use App\Mail\RejectProjectAspiranteCron;
use App\Project;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RejectedProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:rejected_projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite cada hora buscar proyectos que los aspirantes no han corregido';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now();
        $project = Project::where('published_at', '<=', $date->format('Y-m-d H:i:s'))->where('rejected', false)->first();
        if($project){
            $project->rejected = true;
            $project->save();
            \Mail::to('smgutierrez@unimayor.edu.co')->send(new RejectProjectAspiranteCron('Mauricio'));
        }

    }
}