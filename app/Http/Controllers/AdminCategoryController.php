<?php

namespace App\Http\Controllers;
use App\Models\FoodCategories;

use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
     public function index() {
        $categories = FoodCategories::with(['kategoriPengusaha'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }
}
