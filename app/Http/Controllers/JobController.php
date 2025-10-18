<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JobController extends Controller
{
    public function store(Request $request)
    {
        $Job = Job::create($request->all());
        return response()->json([
            'message' => 'create job has been successfully !',
            'data' => $Job
        ]);
    }
}
