<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormativeUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shortname',
    ];

    public function modul() {
        return $this->belongsTo(Modul::class);
    }
    public function evals() {
        return $this->hasMany(Evaluation::class);
    }
}
