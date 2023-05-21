<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Modul;
use App\Models\FormativeUnit;

class FormativeUnitController extends Controller
{
    public function index()
    {
        $ufs = FormativeUnit::all();
        return response()->json([
            'success' => true,
            'data' => $ufs->toArray()
        ], 200);
    }
    public function show(string $id)
    {
        $uf = FormativeUnit::find($id);
        if (!$uf) {
            return response()->json([
                'success' => false,
                'msg' => "Formative Unit not found.",
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $uf->toArray()
        ], 200);
    }

    public function showByModul(Request $request, $m_id)
    {
        $ufs = FormativeUnit::where('modul_id', $m_id);
        return response()->json($ufs);
    }

    public function store(Request $request)
    {
        $md = Modul::find($request->modul_id);
        $validated = $request->validate([
            'name' => 'string|max:24|min:2',
            'shortname' => 'string|max:8|min:2',
        ]);
        $validated = $request->merge(['modul_id' => $md->id]);
        $uf = FormativeUnit::factory()->create($validated->toArray());
        $uf->save();

        return response()->json([
            'success' => true,
            'msg' => 'Successfully created UF!'
        ]);
    }

    public function update(Request $request, string $id)
    {
        $uf = FormativeUnit::find($id);
        if (!isset($uf->id)) {
            return response()->json([
                'success' => false,
                "msg" => "UF with id {$id} does not exist!",
            ],404);
        }

        $validated = $request->validate([
            'name' => 'string|max:24|min:2',
            'shortname' => 'string|max:8|min:2',
        ]);
        $uf->fill($validated->toArray());
        $uf->save();

        $successresult_array = [
            'success' => true,
            'msg' => 'Successfully updated UF info!',
        ];
        return response()->json($successresult_array);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $uf = FormativeUnit::find($id);
        if (!$uf) {
            return response()->json([
                'success' => false,
                "msg" => "UF with id {$id} does not exist!",
            ],404);
        }
        $uf->delete();
        return response()->json([
            'success' => true,
            'msg' => 'Successfully deleted UF.',
        ]);
    }
}
