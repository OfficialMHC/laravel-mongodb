<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authors.index', [
            'authors' => Author::with('books:_id,author_id')->likeSearch('name')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:authors,name'
        ]);

        try {

            Author::create([
                'name'      => $request->name, 
                'status'    => $request->status ?? 0
            ]);
            return redirect()->route('authors.index')->withSuccess('Author has been created successfully!');

        } catch (\Throwable $th) {
            return redirect()->route('authors.index')->withError('Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => ['required', Rule::unique('authors')->ignore($author)]
        ]);

        try {

            $author->update([
                'name'      => $request->name, 
                'status'    => $request->status ?? 0
            ]);
            return redirect()->route('authors.index')->withSuccess('Author has been updated successfully!');

        } catch (\Throwable $th) {
            return redirect()->route('authors.index')->withError('Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        try {

            $author->delete();
            return redirect()->route('authors.index')->withSuccess('Author has been deleted successfully!');

        } catch (\Throwable $th) {
            return redirect()->route('authors.index')->withError('Something went wrong!');
        }
    }
}
