<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function category()
    {
        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            $all_sub_categories = SubCategory::where('admin_or_user_id', '=', $userId)->get();
            $all_categories = Category::where('admin_or_user_id', '=', $userId)->get();

            return view('admin_panel.category.category', [
                'all_sub_categories' => $all_sub_categories,
                'all_categories' => $all_categories
            ]);
        } else {
            return redirect()->back();
        }
    }
    public function store_category(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            $userId = Auth::id();
            //  $all_sub_categories = SubCategory::where('admin_or_user_id', '=', $userId)->get();
            Category::create([
                'admin_or_user_id'    => $userId,
                'sub_category_name'   => $request->sub_category_name,
                'category_name'     => $request->category_name,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
            return redirect()->back()->with('Category-added', 'Category Added Successfully');
        } else {
            return redirect()->back();
        }
    }
    public function update_category(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $categoryId = $request->categoryId;
    
            Category::where('id', '=', $categoryId)->update([
                'sub_category_name' => $request->subCategoryName,
                'category_name' => $request->category_name,
                'updated_at' => Carbon::now(),
            ]);
    
            $message = 'Subcategory Updated Successfully';
            // Return a JSON response with the custom message
            return response()->json(['message' => $message]);
        } else {
            return redirect()->back();
        }
    }
}
