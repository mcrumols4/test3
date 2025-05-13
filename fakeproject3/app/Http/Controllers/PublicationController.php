<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Publication;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = DB::table('publications')->orderBy('updated_at')->paginate(5);

        $categories = Category::all(['id', 'name']);

        return Inertia::render('PublicationsList', [
            'publications' => $publications,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:2|max:100',
            'description' => 'required|min:2|max:1500',
            'email' => 'required|email:rfc',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        Publication::create([
            'title' => $validated["title"],
            'description' => $validated["description"],
            'email' => $validated["email"],
            'category_id' => $validated["category_id"],
            'user_id' => $validated["user_id"],
        ]);

        return redirect("/dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publication = Publication::all()->where("id", $id)->first();

        $datetime = Carbon::parse($publication["updated_at"]);
        $date = $datetime->format("d-m-y");
        $hour = $datetime->format("H:i");

        return Inertia::render('Publication', [
            'publication' => $publication,
            'date' => $date,
            'hour' => $hour,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $publication = Publication::find($id);
        $categories = Category::all("id", "name");
        return Inertia::render('Edit', [
            'publication' => $publication,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id' => 'required|exists:publications,id',
            'title' => 'required|min:2|max:100',
            'description' => 'required|min:2|max:1500',
            'email' => 'required|email:rfc',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $updatable = Publication::find($validated["id"]);

        $updatable->update([
            'title' => $validated["title"],
            'description' => $validated["description"],
            'email' => $validated["email"],
            'category_id' => $validated["category_id"],
        ]);

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = Auth::getUser()->id;

        $publication = Publication::find($id);
        $publication->delete();

        $publications = Publication::all()->where('user_id', $userId);

        return $publications;
    }

     public function reload(Request $request)
    {
        $category = $request->get('category');
        $page = $request->get('page');
        if ($category != "all") {
            $publications = DB::table('publications')->where('category_id', $category)->orderBy('updated_at')->paginate($request->get('number'), page: $page);
        } else {
            $publications = DB::table('publications')->orderBy('updated_at')->paginate($request->get('number'));
        }
        
        return $publications;
    }
}
