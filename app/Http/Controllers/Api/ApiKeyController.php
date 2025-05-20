<?php

namespace App\Http\Controllers\Api;

use App\Models\ApiKey;
use Illuminate\Http\Request;

class ApiKeyController
{
    public function index()
    {
        return response()->json(ApiKey::with('user')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'secret_key' => 'required|string|unique:api_keys,secret_key',
        ]);

        $apiKey = ApiKey::create($validated);

        return response()->json($apiKey->load('user'), 201);
    }

    public function show($id)
    {
        $apiKey = ApiKey::with('user')->find($id);

        if (!$apiKey) {
            return response()->json(['message' => 'API key cannot be found'], 404);
        }

        return response()->json($apiKey);
    }

    public function update(Request $request, $id)
    {
        $apiKey = ApiKey::find($id);

        if (!$apiKey) {
            return response()->json(['message' => 'API key cannot be found'], 404);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'name' => 'sometimes|string|max:255',
            'secret_key' => 'sometimes|string|unique:api_keys,secret_key,' . $apiKey->id,
        ]);

        $apiKey->update($validated);

        return response()->json($apiKey->load('user'));
    }

    public function destroy($id)
    {
        $apiKey = ApiKey::find($id);

        if (!$apiKey) {
            return response()->json(['message' => 'API key cannot be found'], 404);
        }

        $apiKey->delete();

        return response()->json(['message' => 'API key deleted successfully']);
        
    }
}
