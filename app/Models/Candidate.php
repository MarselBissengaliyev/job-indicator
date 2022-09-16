<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    public static function create($name, $email, $phone, $jobId) {
        $model = new self();

        $model->name = $name;
        $model->email = $email;
        $model->phone = $phone;
        $model->job_id= $jobId;

        $model->save();
        return $model;
    }
}
