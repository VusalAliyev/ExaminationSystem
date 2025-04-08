<?php

namespace App\Http\Controllers;

use App\Models\ForeignLanguage;
use Illuminate\Http\Request;

class ForeignLanguagesController extends Controller
{
    public function index()
    {
        $foreignLanguages = ForeignLanguage::all();
        return view('admin.foreign-languages.index', compact('foreignLanguages'));
    }

    public function create()
    {
        return view('admin.foreign-languages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ForeignLanguage::create($validated);
        return redirect()->route('foreign-languages.index')->with('success', 'Xarici dil uğurla yaradıldı.');
    }

    public function show($id)
    {
        $foreignLanguage = ForeignLanguage::findOrFail($id);
        return view('admin.foreign-languages.show', compact('foreignLanguage'));
    }

    public function edit($id)
    {
        $foreignLanguage = ForeignLanguage::findOrFail($id);
        return view('admin.foreign-languages.edit', compact('foreignLanguage'));
    }

    public function update(Request $request, $id)
    {
        $foreignLanguage = ForeignLanguage::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $foreignLanguage->update($validated);
        return redirect()->route('foreign-languages.index')->with('success', 'Xarici dil uğurla yeniləndi.');
    }

    public function destroy($id)
    {
        $foreignLanguage = ForeignLanguage::findOrFail($id);
        $foreignLanguage->delete();
        return redirect()->route('foreign-languages.index')->with('success', 'Xarici dil uğurla silindi.');
    }
}
