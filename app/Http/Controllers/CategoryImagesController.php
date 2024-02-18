<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryImages;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Image;

class CategoryImagesController extends Controller
{
    public function category_images()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            $all_sub_categories = SubCategory::where('admin_or_user_id', '=', $userId)->get();
            $all_categories = Category::where('admin_or_user_id', '=', $userId)->get();

            return view('admin_panel.category_images.category_images', [
                'all_sub_categories' => $all_sub_categories,
                'all_categories' => $all_categories
            ]);
        } else {
            return redirect()->back();
        }
    }
    public function get_category(Request $request)
    {
        // dd($request);
        $subCategoryName = $request->subcategory;
        // Perform logic to fetch talukas based on the selected district
        $categories = Category::where('sub_category_name', $subCategoryName)->pluck('category_name', 'category_name');
        // dd($categories);
        return response()->json(['categories' => $categories]);
    }

    public function store_category_images(Request $request)
    {
        if (Auth::id()) {
            // Validate the request
            $userId = Auth::id();
    
            $request->validate([
                'sub_category_name' => 'required',
                'category_name' => 'required',
                'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Handle image upload
            $image = $request->file('images');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'category_images/' . $imageName;
    
            // Save the original image to the public directory
            $image->move(public_path('category_images'), $imageName);
    
            // Create and save the CategoryImage model
            CategoryImages::create([
                'admin_or_user_id' => $userId,
                'sub_category_name' => $request->input('sub_category_name'),
                'category_name' => $request->input('category_name'),
                'images' => $imageName,
            ]);
    
            // Send success response
            return response()->json(['message' => 'Images added successfully'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
