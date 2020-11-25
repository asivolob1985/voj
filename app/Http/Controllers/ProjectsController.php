<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends SiteController {

    public function index(Request $request){
        $alias = $request->alias;
        if($alias){
            $project = Project::findByAlias($alias);
            $other_projects = Project::select(Project::fields_in_mini())->where('alias', '!=', $alias)->active()->get();

            return view('projects.project', compact('project', 'other_projects'));
        }

        $all_projects = Project::select(Project::fields_in_mini())->active()->with('section')->paginate(1);

        if ($request->ajax()) {
            $paginator = $all_projects->links('elements.paginate')->render();
            $view = view('projects.project_in_list', compact('all_projects'))->render();

            return response()->json(['view'=>$view, 'paginator' => $paginator]);
        }

        return view('projects.all', ['all_projects' => $all_projects]);
    }
}
