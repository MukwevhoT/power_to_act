<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgressRequest;
use App\Http\Requests\ProgresstRequest;
use App\Models\Progress;
use Illuminate\Database\ConnectionInterface as DB;
use Illuminate\Http\Response;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class ProgressController extends Controller
{
    private DB $db;
    private Progress $progress;

    /**
     * Inject models into the constructor.
     *
     * @param DB $db
     * @param Progress $progress
     */
    public function __construct(
        DB $db,
        Progress $progress
    ) {
        $this->db = $db;
        $this->progress = $progress;
    }

    public function update(ProgressRequest $request){
        $this->db->beginTransaction();

        $progress = new $this->progress();
        $progress->name = $request->name;
        $progress->milestone = $request->milestone;
        $progress->details = $request->details;
        $progress->save();

        $this->db->commit();

        return ResponseBuilder::asSuccess()
            ->withHttpCode(Response::HTTP_CREATED)
            ->withMessage('Project updated successfully')
            ->withData(['user' => $progress])
            ->build();
    }
}
