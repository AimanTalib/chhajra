<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    
    public function store_sub_category(Request $request)
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
            $userId = Auth::id();
            SubCategory::create([
                'admin_or_user_id'  => $userId,
                'sub_category_name'     => $request->sub_category_name,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
            return redirect()->back()->with('plot-added', 'Plot Added Successfully');
        } else {
            return redirect()->back();
        }
    }
    public function all_sub_category(Request $request)
    {

        if (Auth::id()) {
            $userId = Auth::id();
            // dd($userId);
            $all_sub_categories = SubCategory::where('admin_or_user_id', '=', $userId)->get();

            return view('admin_panel.sub_category.all_sub_category', [
                'all_sub_categories' => $all_sub_categories
            ]);
        } else {
            return redirect()->back();
        }

        
    }
    public function update_subcategory(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $subCategoryId = $request->subCategoryId;
    
            SubCategory::where('id', '=', $subCategoryId)->update([
                'sub_category_name' => $request->subCategoryName,
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
