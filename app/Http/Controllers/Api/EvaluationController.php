<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Evaluation;
use App\Models\FormativeUnit;
use App\Models\User;

class EvaluationController extends Controller
{
    public function index()
    {
        $evs = Auth::user()->evals()->get();
        return response()->json([
            'success' => true,
            'data' => $evs->toArray()
        ], 200);
    }

    public function show(Request $request, string $id)
    {
        $ev = Evaluation::findOrFail($id);
        $evd = $ev->evaluationDetails;
        return response()->json([
            'success' => true,
            'data' => $ev->toArray()
        ], 200);
    }
    public function showAll()
    {
        $ev = Evaluation::all();
        return response()->json([
            'success' => true,
            'data' => $ev->toArray()
        ], 200);
    }
}
