<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    function getProducts(Request $request)
    {
        $search = $request->search;
        $className = $request->className;


        if ($search) {

            if ($className === 'product') {
                $query = Food::query();
                $query->whereHas('categories', function ($q) {

                    $q->whereHas('branches', function ($query) {
                        $query->where('branch_id', auth()->user()->branch_id);
                    });
                })->where('name', 'LIKE', '%' . $search . '%')->select('id', 'name as text');
            } elseif ($className == 'category') {
                $query = Category::query();
                $query->whereHas('branches', function ($query) {
                    $query->where('branch_id', auth()->user()->branch_id);
                })->where('title', 'LIKE', '%' . $search . '%')->select('id', 'title as text');
            }
            $data = $query->get();

            return response()->json([
                'results' => $data,
            ]);
        }
    }
}
