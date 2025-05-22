<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'published_date' => 'nullable|date',
            'stock' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book could not be found'], 404);
        }

        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book could not be found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'sometimes|string|max:13|unique:books,isbn,' . $book->id,
            'published_date' => 'nullable|date',
            'stock' => 'nullable|integer|min:0',
            'price' => 'nullable|numeric|min:0',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book could not be found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
