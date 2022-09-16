<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

    public $visible = [
        'level',
        'competence',
        'candidate_id',
        'job_id',
        'id'
    ];

    use HasFactory;
    public static function create($competence, $level, $candidate_id, $job_id) {
        $model = new self();

        $model->competence = $competence;
        $model->level = $level;
        $model->candidate_id = $candidate_id;
        $model->job_id = $job_id;

        $model->save();
        return $model;
    }

    public function getLevel() {
        return $this->belongsTo(Level::class, 'level', 'level');
    }
    
}
