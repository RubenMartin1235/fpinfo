<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Modul;

class ModulController extends Controller
{
    public function index()
    {
        $md = Modul::all();
        return response()->json($md);
    }
    public function show(string $id)
    {
        $md = Modul::find($id);
        if (!$md) {
            return response()->json([
                'success' => false,
                'msg' => "Module with id {$id} not found.",
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $md->toArray()
        ], 200);
    }

    public function store(Request $request)
    {
        $prof = User::find($request->prof_id);
        $validated = $request->validate([
            'name' => 'string|max:24|min:2',
            'shortname' => 'string|max:8|min:2',
        ]);
        $validated = $request->merge(['prof_id' => $prof->id]);
        $md = Modul::factory()->create($validated->toArray());
        $md->save();

        return response()->json([
            'success' => true,
            'msg' => 'Successfully created module!'
        ]);
    }

    public function update(Request $request, string $id)
    {
        $md = Modul::find($id);
        if (!isset($md->id)) {
            return response()->json([
                'success' => false,
                "msg" => "Module with id {$id} does not exist!",
            ],404);
        }

        $validated = $request->validate([
            'name' => 'string|max:24|min:2',
            'shortname' => 'string|max:8|min:2',
        ]);
        $md->fill($validated->toArray());
        $md->save();

        $successresult_array = [
            'success' => true,
            'msg' => 'Successfully updated module info!',
        ];
        return response()->json($successresult_array);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $md = Modul::find($id);
        if (!$md) {
            return response()->json([
                'success' => false,
                "msg" => "Module with id {$id} does not exist!",
            ],404);
        }
        $md->delete();
        return response()->json([
            'success' => true,
            'msg' => 'Successfully deleted module.',
        ]);
    }
}
