<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        // dd($data);
        return view('admin.data_user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.data_user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users,email',
            'no_tlp'    => 'required|string|max:15',
            'jk'        => 'required|in:Laki-laki,Perempuan',
            'role'      => 'required|in:admin,pegawai,sdm',
            'password'  => 'required|string|min:6',
        ]);

        // Enkripsi password sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Simpan ke database
        User::create($validatedData);

        return redirect()
            ->route('admin.data_user')
            ->with('success', 'Data pendaftaran berhasil disimpan!');
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
        $data = User::findOrfail($id);

        return view('admin.data_user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email',
            'no_tlp'    => 'required|string',
            'jk'        => 'required|in:Laki-laki,Perempuan',
            'role'      => 'required|in:admin,pegawai,sdm',
            'password'  => 'nullable|string|min:6'
        ]);

        $user = User::findOrFail($id);

        // Jika password tidak diubah, jangan timpa
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()
            ->route('admin.data_user')
            ->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = User::findOrFail($id); // findOrFail will throw an exception if not found
        $data->delete();
        return redirect()->route('admin.data_user')->with('success', 'Product deleted successfully');
    }
}
