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
        $project = Project::where('published_at', '<=', $date->format('Y-m-d H:i:s'))->where('rejected', '1')->with('artists.users')->first();
        if($project){
            $project->rejected = '2';
            $project->status = 5;
            $project->save();
            \Mail::to($project->artists[0]->users->email)->send(new \App\Mail\RejectProjectAspiranteCron($project->artists[0]->users->name, $project->artists[0]->users->last_name));
        }

    }
}
