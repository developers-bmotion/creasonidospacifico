<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectsApprovedController extends Controller
{
    public function index() {
        return view('backend.admin.projects-approved');
    }

    public function togglePublish(Request $request) {
        $id = $request->input('id', null);
        if ($id) {
            $project = Project::findOrFail($id);
            // if ($project->status == Project::APPROVAL || $project->status == Project::NOPUBLISHED){
            //     $project->status = Project::PUBLISHED;
            // } else {
            if ($project->status == Project::APPROVAL){
                $project->status = Project::PENDING;
            } else {
                $project->status = Project::APPROVAL;
            }
            $project->save();
        }
        return response()->json([]);
    }
}
