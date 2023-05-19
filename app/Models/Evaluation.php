<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    public function users() {
        return $this->hasManyThrough(EvaluationDetail::class, User::class);
    }
    public function formativeUnits() {
        return $this->hasManyThrough(EvaluationDetail::class, FormativeUnit::class);
    }
}
