<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\DealerStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DealerController extends Controller
{
    public function index()
    {
        $dealers = Dealer::all();
        return response()->json($dealers);
    }

    // Save a new dealer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'integer',
                'regex:/^\d{10}$/',
            ],
            'email' => 'nullable|email|unique:dealers,email',
            'alternative_phone_number' => [
                        'nullable',
                        'integer',
                        'regex:/^\d{10}$/',
                    ],
            'address' => 'nullable|string',
        ],
        [
            'phone_number.regex' => 'The phone number must be exactly 10 digits.',
            'alternative_phone_number.regex' => 'The Alternative number must be exactly 10 digits.',
        ]    
    );

        $dealer = Dealer::create($validated);
        return response()->json(['message' => 'Dealer created successfully', 'dealer' => $dealer], 201);
    }

    // Get a single dealer
    public function show($id)
    {
        $dealer = Dealer::findOrFail($id);
        return response()->json($dealer);
    }

    // Update a dealer
    public function update(Request $request, $id)
    {
        $dealer = Dealer::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'integer',
                'regex:/^\d{10}$/',
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('dealers', 'email')->ignore($id),
            ],    
            'alternative_phone_number' => [
                        'nullable',
                        'integer',
                        'regex:/^\d{10}$/',
                    ],
            'address' => 'nullable|string',
        ],
        [
            'phone_number.regex' => 'The phone number must be exactly 10 digits.',
            'alternative_phone_number.regex' => 'The Alternative number must be exactly 10 digits.',
        ]    
    );

        $dealer->update($validated);
        return response()->json(['message' => 'Dealer updated successfully', 'dealer' => $dealer]);
    }

    // Delete a dealer
    public function destroy($id)
    {
        $dealer = Dealer::findOrFail($id);
        $dealer->delete();
        return response()->json(['message' => 'Dealer deleted successfully']);
    }
    public function fetchdDealersStatus()
    {
        $statuses = DealerStatus::all();
        return response()->json($statuses);
    }
}
