<?php

namespace App\Http\Controllers;
use App\Region;
use App\JobLevel;
use App\JobFunction;
use App\EducationalAttainment;
use App\ApplicantBackground;
use App\Applicant;
use App\WorkExperience;
use App\ApplicantEducation;
use App\Manpower;
use App\MaritalStatus;
use App\ManpowerApplicant;
use App\Consent;
use App\Employee;
use App\ApplicantHistory;

use Illuminate\Http\Request;
use URL;

class ApplicantController extends Controller
{
    //
    public function newApplicant()
    {
        $regions = Region::with('cities')->orderBy('region_name','asc')->get();
       
    
        return view('new_applicant',array(
            'header' => 'Recruitment',
            'subheader' => 'New Applicant',
            'regions' => $regions,

        ));
    }
    public function viewApplicants()
    {
        $manpowerapplicants = ManpowerApplicant::with([
            'manpower_info',
            'manpower_info.position_info',
            'applicant_info',
            'applicant_info.work_experience_info',
            'applicant_info.education_info',
            ]
        )->where('status','=','Pending')->get();
        
        $applicants = Applicant::with('work_experience_info','education_info')
        ->whereDoesntHave('manpower_info', function($query) {
            $query->where('status', '=','For Interview');
          })
        ->get();
        $employees = Employee::with('EmployeeCompany')->where('status','=','Active')->orderBy('first_name','asc')->get();
        return view('viewApplicants',array(
            'header' => 'Recruitment',
            'subheader' => 'Applicants',
            'manpowerapplicants' => $manpowerapplicants,
            'applicants' => $applicants ,
            'employees' => $employees ,

        ));
    }
    public function walkInApplicants ()
    {
        $backgrounds = ApplicantBackground::get();

        return view('applicant_home',array(
            'backgrounds' => $backgrounds,
        ));

    }
    public function newApplicantWalkin ()
    {
        $regions = Region::with('cities')->orderBy('region_name','asc')->get();
        $job_levels = JobLevel::get();
        $job_functions = JobFunction::get();
        $education_attainments = EducationalAttainment::get();
        $marital_statuses = MaritalStatus::get();
        $manpower = Manpower::where('status','=','Approved')->with(
            'request_info',
            'company_info',
            'location_info',
            'location_info.address_info',
            'position_info',
            'position_info.qualifications',
            'department_info',
            'reporting_to_info',
            'manager_info',
            'department_head_info',
            'finance_manager_info',
            'hr_operation_info',
            'hr_head_info',
            'replacement_info')
            ->get();
        // return ($manpower);
        return view('new_applicant_walk_in',array(
            'regions' => $regions,
            'job_levels' => $job_levels,
            'job_functions' => $job_functions,
            'education_attainments' => $education_attainments,
            'marital_statuses' => $marital_statuses,
            'approved_manpower_requests' => $manpower,
        ));
    
    }
    public function saveNewApplicant(Request $request)
    {
        $birthdate = $request->birthYear.'-'.$request->birthMonth.'-'.$request->birthDay;
        $applicant = new Applicant;
        $applicant->first_name = $request->first_name;
        $applicant->last_name = $request->last_name;
        $applicant->region_id = $request->region;
        $applicant->personal_email = $request->email;
        $applicant->city_id = $request->city;
        $applicant->street_address = $request->street_address;
        $applicant->birthdate = $birthdate;
        $applicant->gender = $request->gender;
        $applicant->phone = $request->phone_number;
        $applicant->save();

        if($request->job_title)
        {
            foreach($request->job_title as $key => $job_t)
            {
                $work_experience = new WorkExperience;
                $work_experience->applicant_id = $applicant->id;
                $work_experience->applicant_id = $applicant->id;
                $work_experience->job_title = $job_t;
                $work_experience->company = $request->company[$key];
                $work_experience->from_month = $request->monthStartWork[$key];
                $work_experience->from_year = $request->yearworkstart[$key];
                $work_experience->to_month = $request->monthEndWork[$key];
                $work_experience->to_year = $request->yearworkend[$key];
                $work_experience->job_level = $request->job_level[$key];
                $work_experience->job_function = $request->job_function[$key];
                $work_experience->save();

            }
        }
        if($request->educAttainment)
        {
            foreach($request->educAttainment as $key1 => $educAttain)
            {
                $education = new ApplicantEducation;
                $education->applicant_id = $applicant->id;
                $education->educational_attainment = $educAttain;
                $education->school =  $request->schoolUniversity[$key1];
                $education->start_month =  $request->start_educ[$key1];
                $education->start_year =  $request->year_start_educ[$key1];
                $education->end_month =  $request->end_educ[$key1];
                $education->end_year =  $request->year_end_educ[$key1];
                $education->accomplishments =  $request->accomplishment[$key1];
                $education->save();
            }
        }
        $request->session()->flash('status','Successfully sign up.');
        return back(); 
    }
    public function applicantApply(Request $request)
    {
     
        $consent = Consent::first();
        $regions = Region::with('cities')->orderBy('region_name','asc')->get();
        $job_levels = JobLevel::get();
        $job_functions = JobFunction::get();
        $education_attainments = EducationalAttainment::get();
        $marital_statuses = MaritalStatus::get();
        return view('applicant_outside',array(
            'regions' => $regions,
            'job_levels' => $job_levels,
            'job_functions' => $job_functions,
            'education_attainments' => $education_attainments,
            'marital_statuses' => $marital_statuses,
            'consent' => $consent,
            
        ));
    }
    public function saveApplicantApply(Request $request)
    {
        // dd($request->all());
        $birthdate = $request->birthYear.'-'.$request->birthMonth.'-'.$request->birthDay;
        $applicant = new Applicant;
        $applicant->first_name = $request->first_name;
        $applicant->last_name = $request->last_name;
        $applicant->middle_name = $request->midle_name;
        $applicant->middle_initial = $request->midle_initials;
        $applicant->marital_status = $request->marital_status;
        $applicant->religion = $request->religion;
        $applicant->suffix = $request->suffix;
        $applicant->region_id = $request->region;
        $applicant->personal_email = $request->email;
        $applicant->city_id = $request->city;
        $applicant->street_address = $request->street_address;
        $applicant->permanent_address = $request->permanent_address;
        $applicant->birthdate = $birthdate;
        $applicant->gender = $request->gender;
        $applicant->phone = $request->phone_number;
        $applicant->telephone_number = $request->telephone_number;
        $applicant->hobbies = $request->hobbies;
        if($request->hasFile('file'))
        {
        $attachment = $request->file('file');
        $original_name = $attachment->getClientOriginalName();
        $name = time().'_'.$attachment->getClientOriginalName();
        $attachment->move(public_path().'/avatar_applicant/', $name);
        $file_name = URL::asset('/avatar_applicant/'.$name);
        $applicant->avatar = $file_name;
        }
        if($request->hasFile('resume'))
        {
            $attachment_resume = $request->file('resume');
            $original_name_resume = $attachment_resume->getClientOriginalName();
            $name_resume = time().'_'.$attachment_resume->getClientOriginalName();
            $attachment_resume->move(public_path().'/resume/', $name_resume);
            $file_name_resume = URL::asset('/resume/'.$name_resume);
            $applicant->resume = $file_name_resume;
        }
        $applicant->save();
        // $manpowerApplicant = new ManpowerApplicant;
        // $manpowerApplicant->applicant_id = $applicant->id;
        // $manpowerApplicant->manpower_id = $mrfID;
        // $manpowerApplicant->status = 'Pending';
        // $manpowerApplicant->save();
        if($request->job_title)
        {
            foreach($request->job_title as $key => $job_t)
            {
                $work_experience = new WorkExperience;
                $work_experience->applicant_id = $applicant->id;
                $work_experience->applicant_id = $applicant->id;
                $work_experience->job_title = $job_t;
                $work_experience->company = $request->company[$key];
                $work_experience->from_month = $request->monthStartWork[$key];
                $work_experience->from_year = $request->yearworkstart[$key];
                $work_experience->to_month = $request->monthEndWork[$key];
                $work_experience->to_year = $request->yearworkend[$key];
                $work_experience->job_level = $request->job_level[$key];
                $work_experience->job_function = $request->job_function[$key];
                $work_experience->save();
            }
        }
        if($request->educAttainment)
        {
            foreach($request->educAttainment as $key1 => $educAttain)
            {
                $education = new ApplicantEducation;
                $education->applicant_id = $applicant->id;
                $education->educational_attainment = $educAttain;
                $education->school =  $request->schoolUniversity[$key1];
                $education->start_month =  $request->start_educ[$key1];
                $education->start_year =  $request->year_start_educ[$key1];
                $education->end_month =  $request->end_educ[$key1];
                $education->end_year =  $request->year_end_educ[$key1];
                $education->course =  $request->course[$key1];
                $education->accomplishments =  $request->accomplishment[$key1];
                $education->save();
            }
        }
        $request->session()->flash('status','Successfully Apply.');
        return back(); 
    }
    public function proceedApplicant (Request $request,$applicantID)
    {
        // dd($request->all());
        // dd($request->all());

        $manpowerApplicant = new  ManpowerApplicant;
        $manpowerApplicant->applicant_id = $applicantID;
        $manpowerApplicant->position = $request->position;
        $manpowerApplicant->status = 'For Interview';
        $manpowerApplicant->date_scheduled = $request->date_scheduled;
        $manpowerApplicant->time_scheduled = $request->time_scheduled;
        $manpowerApplicant->remarks = $request->remarks;
        $manpowerApplicant->interview_number = 1;
        $manpowerApplicant->save();
        foreach($request->interviewer as $interview)
        {
            $applicant_history = new ApplicantHistory;
            $applicant_history->applicant_id = $applicantID;
            $applicant_history->interviewer = $interview;
            $applicant_history->action_by = auth()->user()->id;
            $applicant_history->action_made = "For Interview";
            $applicant_history->date_scheduled = $request->date_scheduled;
            $applicant_history->time_scheduled = $request->time_scheduled;
            $applicant_history->remarks = $request->remarks;
            $applicant_history->interview_number = 1;
            $applicant_history->save();
        }
        
        $request->session()->flash('status','Successfully Proceed.');
        return back(); 
    }
    public function forInterview (Request $request)
    {
        $for_interview = ManpowerApplicant::with('applicant_info.work_experience_info','applicant_info.education_info','applicant_history.interviewer_info')
       
       
        ->where('status','=','For Interview')
        ->orderBy('date_scheduled','asc')
        ->get();
        $employees = Employee::with('EmployeeCompany')->where('status','=','Active')->orderBy('first_name','asc')->get();
        // dd($for_interview);
        // dd($for_interview);
        // dd($for_interview);
        return view('for_interview',array(
            'header' => 'Recruitment',
            'subheader' => 'For Interview',
            'for_interviews' => $for_interview,
            'employees' => $employees,
        ));
    }
    public function nextinterview (Request $request,$applicantID)
    {
        // dd($request->all());
        $attachment = $request->file('file');
        $original_name = $attachment->getClientOriginalName();
        $name = time().'_'.$attachment->getClientOriginalName();
        $attachment->move(public_path().'/status/', $name);
        $file_name = URL::asset('/status/'.$name);

        $manpowerApplicant = ManpowerApplicant::findorfail($applicantID);
        $manpowerApplicant->status = 'For Interview';
        $manpowerApplicant->date_scheduled = $request->date_scheduled;
        $manpowerApplicant->time_scheduled = $request->time_scheduled;
        $manpowerApplicant->remarks = $request->remarks;
        $manpowerApplicant->interview_number = $manpowerApplicant->interview_number + 1;
        $manpowerApplicant->save();

        $applicant_history = new ApplicantHistory;
        $applicant_history->manpower_applicant_id = $applicantID;
        $applicant_history->action_by = auth()->user()->id;
        $applicant_history->action_made = "Proceed Next Interview";
        $applicant_history->date_scheduled = $request->date_scheduled;
        $applicant_history->time_scheduled = $request->time_scheduled;
        $applicant_history->remarks = $request->remarks;
        $applicant_history->attachment = $file_name;
        $applicant_history->save();
        $request->session()->flash('status','Successfully Proceed.');
        return back(); 
    }
    public function forRequirements (Request $request)
    { 
        $for_requirements = ManpowerApplicant::with('applicant_info.work_experience_info','applicant_info.education_info')
      
        ->where('status','=','For Requirements')
        ->get();
        return view('for_requirements',array(
            'header' => 'Recruitment',
            'subheader' => 'For Requirements',
            'for_requirements' => $for_requirements,

        ));
    }
    public function newApplicantWalkina()
    {

    }
}
