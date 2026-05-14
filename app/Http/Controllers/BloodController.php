<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use Illuminate\Http\Request;

class BloodController extends Controller
{
    public function index()
    {
        $bloods = Blood::latest()->get();
        return view('bloods.index', compact('bloods'));
    }

    public function create()
    {
        return view('bloods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'bags' => 'required|integer|min:1',
            'status' => 'required|in:available,used,expired',
            'donation_date' => 'required|date',
        ]);

        Blood::create($validated);

        return redirect()->route('bloods.index')
            ->with('success', 'Record added successfully!');
    }

    public function edit(Blood $blood)
    {
        return view('bloods.edit', compact('blood'));
    }

    public function update(Request $request, Blood $blood)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'bags' => 'required|integer|min:1',
            'status' => 'required|in:available,used,expired',
            'donation_date' => 'required|date',
        ]);

        $blood->update($validated);

        return redirect()->route('bloods.index')
            ->with('success', 'Record updated successfully!');
    }

    public function destroy(Blood $blood)
    {
        $blood->delete();

        return redirect()->route('bloods.index')
            ->with('success', 'Record deleted successfully!');
    }

    public function show(Blood $blood)
    {
        return view('bloods.show', compact('blood'));
    }
}