<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {  
        return view('dashboard', [
            'totalAuthors' => Author::count(),
            'totalBooks' => Book::count(),
        ]);
    }
}
