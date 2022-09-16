<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Competence;
use App\Models\Job;
use App\Models\Level;
use App\Models\Skill;
use Illuminate\Http\Request;

class JoblistController extends Controller
{
    public function viewJobs()
    {
        $jobs = Job::query()->get();
        $competences = Competence::query()->get();
        $levels = Level::query()->get();
        $candidates = Candidate::query()->get();
        $skills = Skill::query()->get();

        return view('joblist', [
            'jobs' => $jobs, 
            'competences' => $competences, 
            'levels' => $levels,
            'candidates' => $candidates,
            'skills' => $skills
        ]);
    }

}
