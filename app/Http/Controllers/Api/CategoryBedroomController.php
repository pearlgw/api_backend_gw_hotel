<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryBedroom;
use Illuminate\Http\Request;

class CategoryBedroomController extends Controller
{
    public function index()
    {
        $category_bedrooms = CategoryBedroom::all();
        return response()->json([
            'status' => 'success',
            'category_bedrooms' => $category_bedrooms
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'price' => 'required|integer',
        ]);

        $lastCategoryBedroom = CategoryBedroom::orderBy('code_category_bedroom', 'desc')->first();

        if (!$lastCategoryBedroom) {
            $newCode = 'CTRBDR0001';
        } else {
            $lastCode = substr($lastCategoryBedroom->code_category_bedroom, 6);
            $newNumber = intval($lastCode) + 1;
            $newCode = 'CTRBDR' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        }

        $category_bedroom = CategoryBedroom::create([
            'code_category_bedroom' => $newCode,
            'category_name' => $request->category_name,
            'price' => $request->price,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category bedroom created successfully',
            'category_bedroom' => $category_bedroom,
        ]);
    }

    public function show(string $id)
    {
        $category_bedroom = CategoryBedroom::find($id);
        return response()->json([
            'status' => 'success',
            'category_bedroom' => $category_bedroom
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'price' => 'required|integer',
        ]);

        $category_bedroom = CategoryBedroom::where('id', $id)->update([
            'category_name' => $request->category_name,
            'price' => $request->price,
        ]);

        if (!$category_bedroom) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category bedroom not found or not updated'
            ], 404);
        }

        $updatedCategoryBedroom = CategoryBedroom::find($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Category bedroom updated successfully',
            'category_bedroom' => $updatedCategoryBedroom,
        ]);
    }

    public function destroy(string $id)
    {
        $category_bedroom = CategoryBedroom::find($id);
        $category_bedroom->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully',
            'category_bedroom' => $category_bedroom,
        ]);
    }
}
