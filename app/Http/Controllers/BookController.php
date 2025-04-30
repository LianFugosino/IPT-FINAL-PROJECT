<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request) {
        Book::create($request->all());
        return redirect()->route('books.index');
    }
    public function index()
{
    $books = Book::all();
    return view('books.index', compact('books'));
}

}
