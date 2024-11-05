<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bedroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BedroomController extends Controller
{
    public function index()
    {
        $bedrooms = Bedroom::with('categoryBedroom', 'bedroomImage')->get();
        return response()->json([
            'status' => 'success',
            'bedrooms' => $bedrooms
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_bedrooms_id' => 'required|exists:category_bedrooms,id',
            'main_image_url' => 'required|file|mimes:jpg,png|max:2048',
            'description' => 'required|string',
        ]);

        $lastBedroom = Bedroom::orderBy('code_bedroom', 'desc')->first();

        if (!$lastBedroom) {
            $newCode = 'BDR0001';
        } else {
            $lastCode = substr($lastBedroom->code_bedroom, 3);
            $newNumber = intval($lastCode) + 1;
            $newCode = 'BDR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }

        if ($request->hasFile('main_image_url')) {
            $imagePath = $request->file('main_image_url')->store('bedroom', 'public');
        }

        $bedroom = Bedroom::create([
            'code_bedroom' => $newCode,
            'category_bedrooms_id' => $request->category_bedrooms_id,
            'main_image_url' => $imagePath,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Bedroom created successfully',
            'bedroom' => $bedroom,
        ]);
    }

    public function show(string $id)
    {
        $bedroom = Bedroom::with('categoryBedroom')->find($id);
        return response()->json([
            'status' => 'success',
            'bedroom' => $bedroom
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_bedrooms_id' => 'required|exists:category_bedrooms,id',
            'main_image_url' => 'required|file|mimes:jpg,png|max:2048',
            'description' => 'required|string',
        ]);

        // Temukan bedroom berdasarkan ID
        $bedroom = Bedroom::find($id);

        if (!$bedroom) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bedroom not found'
            ], 404);
        }

        if ($bedroom->main_image_url && Storage::disk('public')->exists($bedroom->main_image_url)) {
            Storage::disk('public')->delete($bedroom->main_image_url);
        }

        if ($request->hasFile('main_image_url')) {
            $newImagePath = $request->file('main_image_url')->store('bedroom', 'public');
        }

        $bedroom->update([
            'category_bedrooms_id' => $request->category_bedrooms_id,
            'main_image_url' => $newImagePath ?? $bedroom->main_image_url,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Bedroom updated successfully',
            'bedroom' => $bedroom,
        ]);
    }

    public function destroy(string $id)
    {
        $bedroom = Bedroom::find($id);

        if (!$bedroom) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bedroom not found'
            ], 404);
        }

        if ($bedroom->main_image_url && Storage::disk('public')->exists($bedroom->main_image_url)) {
            Storage::disk('public')->delete($bedroom->main_image_url);
        }

        $bedroom->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Bedroom deleted successfully',
            'bedroom' => $bedroom,
        ]);
    }
}
