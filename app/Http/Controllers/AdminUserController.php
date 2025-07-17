<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
     public function index() {
        $users = User::all();
            // ->orderBy('created_at', 'desc')
            // ->paginate(10);


        return view('admin.user.index',
            ['users' => $users,]);
    }
}
