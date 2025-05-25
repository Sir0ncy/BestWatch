<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
          if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $types = Type::all();
        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:types,name',
        ]);

        Type::create($validated);

        return redirect()->route('types.index')->with('success', 'Type berhasil ditambahkan.');
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
        //
         if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $type = Type::findOrFail($id);
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $type = Type::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:types,name,' . $type->id,
        ]);

        $type->update($validated);

        return redirect()->route('types.index')->with('success', 'Type berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
         if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $type = Type::findOrFail($id);
        $type->delete();

        return redirect()->route('types.index')->with('success', 'Type berhasil dihapus.');
    }
}
