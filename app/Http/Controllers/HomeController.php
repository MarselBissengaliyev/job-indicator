<?php

namespace App\Http\Controllers;

use App\Competence;
use App\Job;
use App\Level;
use App\Models\Candidate;
use App\Models\Competence as ModelsCompetence;
use App\Models\Job as ModelsJob;
use App\Models\Level as ModelsLevel;
use App\Models\Skill;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function viewHome()
    {
        $jobs = ModelsJob::query()->get();
        $competences = ModelsCompetence::query()->get();
        $levels = ModelsLevel::query()->get();

        return view('home', ['jobs' => $jobs, 'competences' => $competences, 'levels' => $levels]);
    }

    public function addCandidate(Request $request, $jobId)
    {
        $competences = ModelsCompetence::query()->get();
        $parsedCompetences = [];

        foreach ($competences as $item) {
            foreach ($request->all() as $key => $requestItem) {
                if ($key === '_token') {
                    continue;
                }
                $replacedReuest = str_replace('_', ' ', $key);
                if ($item->competence === $replacedReuest) {
                    $parsedCompetences = [...$parsedCompetences, $key];
                }
            }
        }

        $email = $request->get('email');
        $findCandidateByEmail = Candidate::query()->where('email', $email)->first();
        if ($findCandidateByEmail) {
            return $this->updateCandidate($request, $parsedCompetences);
        }

        $validators = [
            'name' => 'required|min:3|max:15',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ];

        foreach ($parsedCompetences as $item) {
            $validators[$item] = 'required|not_in:Select';
        }

        $request->validate($validators);

        $candidate = Candidate::create(
            $request->get('name'),
            $request->get('email'),
            $request->get('phone'),
            $jobId
        );


        foreach ($parsedCompetences as $index => $item) {
            Skill::create(
                $item,
                $request->get(str_replace(' ', '_', $item)),
                $candidate->id,
                $jobId
            );
        }
        return redirect()->route('home')->with('status', 'success');
    }

    public function updateCandidate($request, $parsedCompetences) {
        $name = $request->get('name');
        $phone = $request->get('phone');
        $email = $request->get('email');


        $candidate = Candidate::query()->where('email', $email)->update([
            'name' => $name,
            'phone' => $phone
        ]);

        $skills = Skill::query()->whereIn('competence', array_map(function($item) {
            return str_replace(' ', '_', $item);
        }, $parsedCompetences))->get();

        foreach ($skills as $skill) {
            static $index = -1;
            $index++;   

            $level = $request->all()[$parsedCompetences[$index]];
            $skill->level = $level;

            $skill->save();
        }
        return redirect()->route('home')->with('status', 'updated');
    }
}
