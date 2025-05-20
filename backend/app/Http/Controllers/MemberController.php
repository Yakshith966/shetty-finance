<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string',
            'document_proof_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $member = Member::create($validator->validated());

        return response()->json(['message' => 'Member created', 'data' => $member], 201);
    }
    public function index()
    {
        return response()->json(Member::select('id', 'name')->get());
    }
}
