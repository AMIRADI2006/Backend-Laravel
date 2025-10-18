<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JobController extends Controller
{
//    ذخیره کردن
    public function store(Request $request)
    {
        $Job = Job::create($request->all());
        return response()->json([
            'message' => 'create job has been successfully !',
            'data' => $Job
        ]);
    }

//نمایش دادخ
    public function show(Job $job)
    {
        return response()->json([
            'message'=> 'job has been fetch',
            'data'=> $job
        ]);
    }

//    برای اپدیت مقادیر
    public function update(Job $job , Request $request )
    {
        $job->update(\request()->all());
        $job = Job::find($job->id);
        return response()->json([
            'message' => 'update job has been successfully',
            'data' => $job
        ]);
    }

//برای حذف مقادیر

    public function delete(Job $job)
    {
        $job->delete();
        return response()->json([
            'message' => 'delete job has been successfully'
        ]);
    }



}














