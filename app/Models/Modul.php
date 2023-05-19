<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shortname',
    ];

    public function formativeUnits() {
        return $this->hasMany(FormativeUnit::class);
    }

    public function prof() {
        return $this->belongsTo(User::class, 'prof_id');
    }
}
