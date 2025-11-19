<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('purchases.product')
            ->where('role', 'user')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('admin.index', [
            'users' => $users,
        ]);
    }
}
