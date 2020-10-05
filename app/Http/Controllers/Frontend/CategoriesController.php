<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function show(Category $category){
        //hay que arreglar la consulta

        $projects = \App\Project::
        where('status',Project::PUBLISHED)
        ->where('category_id', $category->id)
        ->with("category","artists",'artists.users', 'donations')->latest()->paginate(8);
        $projects->setCollection( \App\Project::card($projects->getCollection()) );


        $category_name = $category;
        $categories = Category::select('*')->get();
        return view('frontend.projects.projects',compact('projects','categories','category_name'));
    }
}
