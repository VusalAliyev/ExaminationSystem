<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorsController extends Controller
{
    public function index()
    {
        $sectors = Sector::all();
        return view('admin.sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('admin.sectors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sector_name' => 'required|string|max:255',
        ]);

        Sector::create($validated);
        return redirect()->route('sectors.index')->with('success', 'Sektör uğurla yaradıldı.');
    }

    public function show($id)
    {
        $sector = Sector::findOrFail($id);
        return view('admin.sectors.show', compact('sector'));
    }

    public function edit($id)
    {
        $sector = Sector::findOrFail($id);
        return view('admin.sectors.edit', compact('sector'));
    }

    public function update(Request $request, $id)
    {
        $sector = Sector::findOrFail($id);

        $validated = $request->validate([
            'sector_name' => 'required|string|max:255',
        ]);

        $sector->update($validated);
        return redirect()->route('sectors.index')->with('success', 'Sektör uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $sector = Sector::findOrFail($id);
        $sector->delete();
        return redirect()->route('sectors.index')->with('success', 'Sektör uğurla silindi.');
    }
}
