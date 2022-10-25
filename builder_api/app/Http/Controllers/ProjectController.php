<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class ProjectController extends Controller
{
    private DB $db;
    private Project $project;

    /**
     * Inject models into the constructor.
     *
     * @param DB $db
     * @param Project $project
     */
    public function __construct(
        DB $db,
        Project $project
    ) {
        $this->db = $db;
        $this->project = $project;
    }

    public function add_project(ProjectRequest $request){

        $this->db->beginTransaction();

        $project = new $this->project();
        $project->title = $request->title;
        $project->location = $request->location;
        $project->issues = $request->issues;
        $project->contact_person = $request->contact_person;
        $project->facilitator = $project->facilitator;
        $project->save();


        $this->db->commit();
        
        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_CREATED)
            ->withMessage('Project created successfully')
            ->withData(['user' => $project])
            ->build();
    }

    public function retrieve(){

        $projects = $this->project->all();

        return ResponseBuilder::asSuccess()
        ->withHttpCode(Response::HTTP_OK)
        ->withMessage('All projects fetched successfully')
        ->withData(["projects" => $projects])
        ->build();
    }
}
