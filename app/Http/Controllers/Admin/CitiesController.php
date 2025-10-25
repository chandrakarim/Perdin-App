<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = City::all();
        //
        return view('admin.data_kota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.data_kota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'island' => 'required|string|max:100',
            'is_foreign' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        City::create($validated);
        return redirect()->route('admin.data_kota')->with('success', 'Data kota berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::findOrfail($id);


        return view('admin.data_kota.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $city = City::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'island' => 'required|string|max:255',
            'is_foreign' => 'required|in:ya,tidak',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $city->update($request->all());

        return redirect()
            ->route('admin.data_kota')
            ->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = City::findOrFail($id); // findOrFail will throw an exception if not found
        $data->delete();
        return redirect()->route('admin.data_kota')->with('success', 'Product deleted successfully');
    }
}
