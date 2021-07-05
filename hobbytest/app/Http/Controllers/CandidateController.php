<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    // show candidate details
    public function showCandidate()
    {
        $candidate_details = Candidate::orderBy('created_at', 'desc')->get();
        return view('candidates.show_candidate', compact('candidate_details'));
    }

    // newCandidate page redirection
    public function newCandidate()
    {
        return view('candidates.create_candidate');
    }

    //add candidate
    public function addCandidate(Request $request)
    {
        // validation
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'description' => 'max:65535',
                'hobby.*.title' => 'required',
                'language' => 'required',
            ],
            [
                'hobby.*.title.required' => 'Hobby is required!',
            ]
        );
        $data = [];
        $hobby = $request->post('hobby');
        if ($hobby) {
            if (isset($hobby) && is_array($hobby)) {
                $hobbies = json_encode($hobby);
            }
        }
        $data['hobby'] = $hobbies;

        // store data in database
        $candidate_data = Candidate::create([
            'user_id' => Auth::user()->id,
            'hobby_id' => Auth::user()->id,
            'name' => $request->name,
            'surname' => $request->surname,
            'hobby_name' => $data['hobby'],
            'description' => $request->description,
            'language' => $request->language,
        ]);
        return redirect()->route('candidate')->with('success', 'Candidate Created successfully!');
    }

    // delete candidate
    public function deleteCandidate($id)
    {
        $delete_candidate = Candidate::where('id', $id)->first();
        if (Auth::user()->id == $delete_candidate->user_id) {
            if ($delete_candidate != null) {
                $delete_candidate->delete();
            }
            return redirect()->route('candidate')->with('success', 'Candidate deleted successfully!');
        } else {
            return redirect()->route('candidate');
        }
    }

    // edit candidate details
    public function editCandidate($id)
    {
        $get_user_id = Candidate::where('id', $id)->first();
        if (Auth::user()->id == $get_user_id->user_id) {
            $edit_candidate_details = Candidate::find($id);
            return view('candidates.edit_candidate', compact('edit_candidate_details'));
        } else {
            return redirect()->route('candidate');
        }
    }

    // update candidate
    public function updateCandidate(Request $request, $id)
    {
        $get_user_id = Candidate::where('id', $id)->first();
        if (Auth::user()->id == $get_user_id->user_id) {
            $validated = $request->validate(
                [
                    'name' => 'required|max:255',
                    'surname' => 'required|max:255',
                    'description' => 'max:65535',
                    'hobby.*.title' => 'required',
                    'language' => 'required',
                ],
                [
                    'hobby.*.title.required' => 'Hobby is required!',
                ]
            );
            $data = [];
            $hobby = $request->post('hobby');
            if ($hobby) {
                if (isset($hobby) && is_array($hobby)) {
                    $hobbies = json_encode($hobby);
                }
            }
            $data['hobby'] = $hobbies;
            $candidate_data = Candidate::find($id)->update([
                'user_id' => Auth::user()->id,
                'hobby_id' => Auth::user()->id,
                'name' => $request->name,
                'surname' => $request->surname,
                'hobby_name' => $data['hobby'],
                'description' => $request->description,
                'language' => $request->language,
            ]);
            return redirect()->route('candidate')->with('success', 'Candidate Updated successfully!');
        } else {
            return redirect()->route('candidate');
        }
    }
    public function editHobby($id)
    {
        $edit_candidate_details  = Candidate::find($id);
        return view('candidates.edit_candidate#candidate_hobby', compact('edit_candidate_details'));
    }
}
