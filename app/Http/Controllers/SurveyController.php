<?php

namespace App\Http\Controllers;

use App\AdminModel;
use App\com;
use App\Survey;
use App\SurveyCount;
use App\UserSurveyAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

session_start();

class SurveyController extends Controller
{
    public function index()
    {
        $user_ses = $_SESSION['admin_master'];
        $user = AdminModel::find($user_ses->id);
        return view('admin.survey.survey_list')->with(['surveys' => Survey::get(), 'user' => $user]);
    }

    public function create()
    {
        return view('admin.survey.create_survey');
    }

    public function store(Request $request)
    {
//        if ($request->file('add_img') == null) {
//            return Redirect::back()->withInput()->withErrors('Please select any image');
//        }
        $survey = new Survey();
        $survey->question = request('question');
        $survey->question_type = request('question_type');
        $survey->option1 = request('option1');
        $survey->option2 = request('option2');
        $survey->option3 = request('option3');
        $survey->option4 = request('option4');
        $survey->survey_amount = request('survey_amount');
        $survey->no_of_user = request('no_of_user');
        $survey->save();
        $survey_count = new SurveyCount();
        $survey_count->survey_id = $survey->id;
        $survey_count->save();
        return redirect('survey')->with('message', 'Survey has been added...!');
    }


    public function edit($id)
    {
        $survey = Survey::find($id);
        return view('admin.survey.edit_survey')->with(['survey' => $survey]);
    }

    public function update($id, Request $request)
    {
//        if ($request->file('add_img') == null) {
//            return Redirect::back()->withInput()->withErrors('Please select any image');
//        }
        $survey = Survey::find($id);
        $survey->question = request('question');
        $survey->question_type = request('question_type');
        $survey->option1 = request('option1');
        $survey->option2 = request('option2');
        $survey->option3 = request('option3');
        $survey->option4 = request('option4');
        $survey->survey_amount = request('survey_amount');
        $survey->no_of_user = request('no_of_user');
        $survey->save();
        return redirect('survey')->with('message', 'Survey has been updated...!');
    }

    public
    function destroy($id)
    {
        $survey = Survey::find($id);
        $survey->is_active = 0;
        $survey->save();
        return redirect('survey')->with('message', 'Survey has been Inactivated...!');
    }

    public
    function show($id)
    {
        $survey = Survey::find($id);
        $survey->is_active = 1;
        $survey->save();
        return redirect('survey')->with('message', 'Survey has been activated...!');
    }

    public function view_survey()
    {
        $id = request('survey_id');
        $survey = Survey::find($id);
        $user = $_SESSION['user_master'];
        $user_survey = UserSurveyAmount::where(['survey_id' => $id, 'user_id' => $user->id])->first();
        return view('front_survey.view_survey')->with(['survey' => $survey, 'user_survey' => $user_survey]);
    }

    public function save_survey()
    {
        $id = request('survey_id');
        $survey = Survey::find($id);
        $user = $_SESSION['user_master'];
        $user_survey = UserSurveyAmount::where(['survey_id' => $id, 'user_id' => $user->id])->first();
        if (!isset($user_survey)) {
            $survey_count = SurveyCount::where(['survey_id' => $survey->id])->first();
            $survey_count->option1_count += request('survey_ans') == 1 ? 1 : 0;
            $survey_count->option2_count += request('survey_ans') == 2 ? 1 : 0;
            $survey_count->option3_count += request('survey_ans') == 3 ? 1 : 0;
            $survey_count->option4_count += request('survey_ans') == 4 ? 1 : 0;
            $survey_count->save();

            $amt = $survey->survey_amount / $survey->no_of_user;
            if ($amt > 0) {
                $user_survey_amt = new UserSurveyAmount();
                $user_survey_amt->user_id = $user->id;
                $user_survey_amt->survey_id = $id;
                $user_survey_amt->amt = $amt;
                $user_survey_amt->survey_ans = request('survey_ans');
                $user_survey_amt->save();
                $survey->total_distributed += $amt;
                $survey->save();
                /********Survey View Amt(Commision)*********/
                $com = new com();
                $com->ParentID = $user->id;
                $com->Com = round($amt, 2);
                $com->SourceID = 'Ads';
                $com->save();
                /********Survey View Amt(Commision)*********/
            }
        } else {
            $survey_count = SurveyCount::where(['survey_id' => $survey->id])->first();
            if ($user_survey->survey_ans == 1)
                $survey_count->option1_count -= 1;
            elseif ($user_survey->survey_ans == 2)
                $survey_count->option2_count -= 1;
            elseif ($user_survey->survey_ans == 3)
                $survey_count->option3_count -= 1;
            elseif ($user_survey->survey_ans == 4)
                $survey_count->option4_count -= 1;
            $survey_count->save();

            if (request('survey_ans') == 1)
                $survey_count->option1_count += 1;
            elseif (request('survey_ans') == 2)
                $survey_count->option2_count += 1;
            elseif (request('survey_ans') == 3)
                $survey_count->option3_count += 1;
            elseif (request('survey_ans') == 4)
                $survey_count->option4_count += 1;
            $survey_count->save();

            $user_survey->survey_ans = request('survey_ans');
            $user_survey->save();


        }
        return 'Success';
    }
}
