<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Gantilah dengan data dari database sesuai kebutuhan
        $visitors = 1240;
        $reviews = 340;
        $rating = 4.5;

        return view('dashboard-pengusaha', compact('visitors', 'reviews', 'rating'));
    }
}
