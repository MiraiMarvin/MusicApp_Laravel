<?php


namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apiKeys = auth()->user()->apiKeys; 
        return inertia('ApiKeys/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }


    public function create()
    {
        return Inertia::render('ApiKeys/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $apiKey = new ApiKey([
            'uuid' => Str::uuid(),
            'user_id' => auth()->id(),
            'name' => $request->name,
            'key' => Str::random(32),
        ]);

        $apiKey->save();

        return redirect()->route('api-keys.index')->with('success', 'API key created successfully.');
    }

    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();
        return redirect()->route('api-keys.index')->with('success', 'API key deleted successfully.');
    }
}
