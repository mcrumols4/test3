<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Publication;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::getUser()->id;

        $publications = Publication::all()->where('user_id', $userId);
        
        return Inertia::render('Dashboard', [
            'categories' => Category::all(["id", "name"]),
            'publications' => $publications,
            'user_id' => $userId,
        ]);
    }
}
