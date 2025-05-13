<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class AdvertisementController extends Controller
{
    public function index() :Response 
    {
        $ads = DB::table('advertisements')->orderBy('updated_at')->paginate(5);

        $categories = Category::all(['id', 'name']);

        return Inertia::render('AdvertisementList', [
            'ads' => $ads,
            'categories' => $categories,
        ]);
    }

    public function reload(Request $request) : LengthAwarePaginator
    {
        $category = $request->get('category');
        $page = $request->get('page');
        if ($category != "all") {
            $ads = DB::table('advertisements')->where('category_id', $category)->orderBy('updated_at')->paginate($request->get('number'), page: $page);
        } else {
            $ads = DB::table('advertisements')->orderBy('updated_at')->paginate($request->get('number'));
        }
        
        return $ads;
    }

    public function show($id) : Response
    {
        $ad = Advertisement::all()->where("id", $id)->first();

        $datetime = Carbon::parse($ad["updated_at"]);
        $date = $datetime->format("d-m-y");
        $hour = $datetime->format("H:i");

        return Inertia::render('Advertisement', [
            'ad' => $ad,
            'date' => $date,
            'hour' => $hour,
        ]);
    }

    public function create(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|min:2|max:100',
            'description' => 'required|min:2|max:1500',
            'email' => 'required|email:rfc',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Advertisement::create([
            'title' => $validated["title"],
            'description' => $validated["description"],
            'email' => $validated["email"],
            'category_id' => $validated["category_id"],
            'user_id' => $validated["user_id"],
        ]);

        return redirect("/ads");

    }

    public function update(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'id' => 'required|exists:advertisements,id',
            'title' => 'required|min:2|max:100',
            'description' => 'required|min:2|max:1500',
            'email' => 'required|email:rfc',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $updatable = Advertisement::find($validated["id"]);

        $updatable->update([
            'title' => $validated["title"],
            'description' => $validated["description"],
            'email' => $validated["email"],
            'category_id' => $validated["category_id"],
        ]);

        return redirect('/dashboard');
    }

    public function loadUpdateForm($id) : Response
    {
        $ad = Advertisement::find($id);
        $categories = Category::all("id", "name");
        return Inertia::render('Update', [
            'ad' => $ad,
            'categories' => $categories
        ]);
    }

    public function dashboard() :Response
    {
        $userId = Auth::getUser()->id;

        $ads = Advertisement::all()->where('user_id', $userId);
        
        return Inertia::render('Dashboard', [
            'categories' => Category::all(["id", "name"]),
            'ads' => $ads,
            'user_id' => $userId,
        ]);
    }

    public function delete($id) : Collection 
    {
        $userId = Auth::getUser()->id;

        $ad = Advertisement::find($id);
        $ad->delete();

        $ads = Advertisement::all()->where('user_id', $userId);

        return $ads;
    }
}
