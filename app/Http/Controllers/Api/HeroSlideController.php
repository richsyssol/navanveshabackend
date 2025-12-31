<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    /**
     * Display a listing of active hero slides.
     */
    public function index()
    {
        try {
            // Get active slides ordered by order column
            $slides = HeroSlide::where('is_active', true)
                ->orderBy('order', 'asc')
                ->get()
                ->map(function ($slide) {
                    return [
                        'id' => $slide->id,
                        'title' => $slide->title,
                        'subtitle' => $slide->subtitle,
                        'description' => $slide->description,
                        'image' => $slide->image,
                        'image_url' => $slide->image_url, // Using the accessor
                        'icon' => $slide->icon,
                        'order' => $slide->order,
                        'is_active' => $slide->is_active,
                        'created_at' => $slide->created_at,
                        'updated_at' => $slide->updated_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Hero slides retrieved successfully',
                'data' => $slides
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve hero slides',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created hero slide.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'order' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        $slide = HeroSlide::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Hero slide created successfully',
            'data' => $slide
        ], 201);
    }

    /**
     * Display the specified hero slide.
     */
    public function show($id)
    {
        try {
            $slide = HeroSlide::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $slide
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hero slide not found'
            ], 404);
        }
    }

    /**
     * Update the specified hero slide.
     */
    public function update(Request $request, $id)
    {
        try {
            $slide = HeroSlide::findOrFail($id);

            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'subtitle' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'image' => 'sometimes|string',
                'icon' => 'nullable|string|max:50',
                'order' => 'sometimes|integer|min:0',
                'is_active' => 'sometimes|boolean'
            ]);

            $slide->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Hero slide updated successfully',
                'data' => $slide
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update hero slide'
            ], 500);
        }
    }

    /**
     * Remove the specified hero slide.
     */
    public function destroy($id)
    {
        try {
            $slide = HeroSlide::findOrFail($id);
            $slide->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hero slide deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete hero slide'
            ], 500);
        }
    }
}