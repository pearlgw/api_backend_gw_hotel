<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BedroomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BedroomImageController extends Controller
{
    public function index()
    {
        $bedroom_images = BedroomImage::with('bedroom')->get();
        return response()->json([
            'status' => 'success',
            'bedroom_images' => $bedroom_images
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bedrooms_id' => 'required|exists:bedrooms,id',
            'image_url' => 'required|array',
            'image_url.*' => 'file|mimes:jpg,png|max:2048',
        ]);

        $imagePaths = [];

        foreach ($request->file('image_url') as $file) {
            $imagePath = $file->store('bedroom', 'public');

            $bedroomImage = BedroomImage::create([
                'bedrooms_id' => $request->bedrooms_id,
                'image_url' => $imagePath,
            ]);

            $imagePaths[] = $bedroomImage;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Bedroom Images created successfully',
            'bedroom_images' => $imagePaths, 
        ]);
    }

    public function show(string $id)
    {
        $bedroom_image = BedroomImage::with('bedroom')->find($id);
        return response()->json([
            'status' => 'success',
            'bedroom_image' => $bedroom_image
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bedrooms_id' => 'required|exists:bedrooms,id',
            'image_url.*' => 'required|file|mimes:jpg,png|max:2048', // Validasi untuk array gambar
        ]);

        // Temukan bedroom images berdasarkan ID
        $bedroom_images = BedroomImage::where('bedrooms_id', $id)->get();

        // Menghapus gambar lama jika diinginkan
        foreach ($bedroom_images as $bedroom_image) {
            if ($bedroom_image->image_url && Storage::disk('public')->exists($bedroom_image->image_url)) {
                Storage::disk('public')->delete($bedroom_image->image_url);
            }
            $bedroom_image->delete(); // Menghapus gambar dari database
        }

        // Simpan gambar baru
        $newImagePaths = [];
        if ($request->hasFile('image_url')) {
            foreach ($request->file('image_url') as $file) {
                $newImagePath = $file->store('bedroom', 'public'); // Menyimpan gambar baru
                $newImagePaths[] = $newImagePath; // Menyimpan path gambar baru
            }
        }

        // Menyimpan gambar baru ke dalam database
        foreach ($newImagePaths as $imagePath) {
            BedroomImage::create([
                'bedrooms_id' => $request->bedrooms_id,
                'image_url' => $imagePath,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Bedroom Images updated successfully',
            'bedroom_images' => $newImagePaths, // Mengembalikan data gambar baru
        ]);
    }

    public function destroy($id)
    {
        $bedroom_image = BedroomImage::find($id);

        if (!$bedroom_image) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bedroom Image not found'
            ], 404);
        }

        if ($bedroom_image->image_url && Storage::disk('public')->exists($bedroom_image->image_url)) {
            Storage::disk('public')->delete($bedroom_image->image_url);
        }

        $bedroom_image->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Bedroom Image deleted successfully',
            'bedroom_image' => $bedroom_image,
        ]);
    }
}
