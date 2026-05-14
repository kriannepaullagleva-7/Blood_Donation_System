<?php
namespace App\Http\Controllers;
use App\Models\Blood;
use Illuminate\Http\Request;

class BloodController extends Controller {

    public function index() {
        $bloods = Blood::latest()->get();
        return view('bloods.index', compact('bloods'));
    }

    public function create() {
        return view('bloods.create');
    }

    public function store(Request $request) {
        $request->validate([
            'donor_name' => 'required',
            'blood_type' => 'required',
            'bags' => 'required|integer',
            'status' => 'required',
            'donation_date' => 'required|date',
        ]);
        Blood::create($request->all());
        return redirect()->route('bloods.index')->with('success', 'Record added!');
    }

    public function edit(Blood $blood) {
        return view('bloods.edit', compact('blood'));
    }

    public function update(Request $request, Blood $blood) {
        $request->validate([
            'donor_name' => 'required',
            'blood_type' => 'required',
            'bags' => 'required|integer',
            'status' => 'required|in:available,used,expired',
            'donation_date' => 'required|date',
        ]);
        $blood->update($request->validated());
        return redirect()->route('bloods.index')->with('success', 'Record updated!');
    }

    public function destroy(Blood $blood) {
        $blood->delete();
        return redirect()->route('bloods.index')->with('success', 'Record deleted!');
    }

    public function show(Blood $blood) {}
}