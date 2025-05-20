<?php

namespace App\Http\Controllers;

use App\Models\BorrowRecord;
use Illuminate\Http\Request;

class BorrowRecordController
{
    public function index()
    {
        $records = BorrowRecord::with(['user', 'book'])->get();
        return response()->json($records);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'borrowed_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:borrowed_date',
        ]);

        $record = BorrowRecord::create($validated);

        return response()->json($record->load(['user', 'book']), 201);
    }

    public function show($id)
    {
        $record = BorrowRecord::with(['user', 'book'])->find($id);

        if (!$record) {
            return response()->json(['message' => 'Borrow record not found'], 404);
        }

        return response()->json($record);
    }

    public function update(Request $request, $id)
    {
        $record = BorrowRecord::find($id);

        if (!$record) {
            return response()->json(['message' => 'Borrow record not found'], 404);
        }

        $validated = $request->validate([
            'book_id' => 'sometimes|exists:books,id',
            'user_id' => 'sometimes|exists:users,id',
            'borrowed_date' => 'sometimes|date',
            'return_date' => 'nullable|date|after_or_equal:borrowed_date',
        ]);

        $record->update($validated);

        return response()->json($record->load(['user', 'book']));
    }

    public function destroy($id)
    {
        $record = BorrowRecord::find($id);

        if (!$record) {
            return response()->json(['message' => 'Borrow record not found'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Borrow record deleted successfully']);
    }
}
