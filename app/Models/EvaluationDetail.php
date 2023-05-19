<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function formativeUnit() {
        return $this->belongsTo(FormativeUnit::class);
    }
    public function evaluation() {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
}
