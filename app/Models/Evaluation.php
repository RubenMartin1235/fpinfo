<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    public function evaluationDetails() {
        return $this->hasMany(EvaluationDetail::class);
    }
    /*
    public function users() {
        return $this->hasManyThrough(User::class, EvaluationDetail::class, 'evaluation_id', 'id');
    }
    public function formativeUnits() {
        return $this->hasManyThrough(FormativeUnit::class, EvaluationDetail::class);
    }
    */
}
