<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index', [
            'books' => Book::likeSearch('name')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create', [
            'authors' => Author::orderBy('name', 'ASC')->pluck('name', '_id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'author_id'     => ['required'],
            'name'          => [
                                'required', 
                                Rule::unique('books')->where('author_id', $request->author_id)
                            ],
            'num_of_page'   => ['required'],
            'price'         => ['required'],
        ]);

        try {

            Book::create([
                'author_id'     => $request->author_id, 
                'name'          => $request->name, 
                'num_of_page'   => $request->num_of_page, 
                'price'         => $request->price, 
                'status'        => $request->status ?? 0
            ]);

            return redirect()->route('books.index')->withSuccess('Book has been created successfully!');

        } catch (\Throwable $th) {
            return redirect()->route('books.index')->withError('Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', [
            'authors'   => Author::orderBy('name', 'ASC')->pluck('name', '_id'),
            'book'      => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'author_id'     => ['required'],
            'name'          => [
                                'required', 
                                Rule::unique('books')->where('author_id', $request->author_id)->ignore($book)
                            ],
            'num_of_page'   => ['required'],
            'price'         => ['required'],
        ]);

        try {

            $book->update([
                'author_id'     => $request->author_id, 
                'name'          => $request->name, 
                'num_of_page'   => $request->num_of_page, 
                'price'         => $request->price, 
                'status'        => $request->status ?? 0
            ]);

            return redirect()->route('books.index')->withSuccess('Book has been updated successfully!');

        } catch (\Throwable $th) {
            return redirect()->route('books.index')->withError('Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {

            $book->delete();
            return redirect()->route('books.index')->withSuccess('Book has been deleted successfully!');

        } catch (\Throwable $th) {
            return redirect()->route('books.index')->withError('Something went wrong!');
        }
    }
}
