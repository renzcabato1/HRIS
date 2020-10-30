<?php

namespace App\Http\Controllers;
use App\Job;
use App\JobLevel;
use App\JobQualification;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //
   
    public function viewPositions()
    {

        $jobs = Job::with('qualifications')->get();
        $job_levels = JobLevel::get();
        return view('view_positions',array(
            'header' => 'Settings',
            'subheader' => 'Positions',
            'jobs' => $jobs,
            'job_levels' => $job_levels,

        ));
    }
    public function newPosition (Request $request)
    {
        $requirements = new Job;
        $requirements->job_title  = $request->job_title;
        $requirements->job_description  = $request->jobDescription;
        $requirements->job_level  = $request->job_level;
        $requirements->save();

        if($request->requirement)
        {
            foreach($request->requirement as $requirement)
            {
                $job_requirement = new JobQualification;
                $job_requirement->job_id = $requirements->id;
                $job_requirement->qualification = $requirement;
                $job_requirement->save();
            }
        }
        $request->session()->flash('status','Successfully add.');
        return back(); 
    }
    public function viewJobDescription(Request $request)
    {
        $job = Job::where('id',$request->jobId)->with('qualifications')->first();
        return $job;
    }
    public function saveEditJob (Request $request)
    {
        $requirements =  Job::findOrfail($request->jobId);
        $requirements->job_title  = $request->job_title;
        $requirements->job_description  = $request->jobDescription;
        $requirements->job_level  = $request->job_level;
        $requirements->save();
        $job_requirement = JobQualification::where('job_id',$request->jobId)->delete();
        if($request->requirement)
        {
            foreach($request->requirement as $requirement)
            {
                $job_requirement = new JobQualification;
                $job_requirement->job_id = $requirements->id;
                $job_requirement->qualification = $requirement;
                $job_requirement->save();
            }
        }
        $request->session()->flash('status','Successfully Updated.');
        return back(); 
    }
}
