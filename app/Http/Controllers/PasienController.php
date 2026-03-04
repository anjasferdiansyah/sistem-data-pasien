<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('noHP', 'like', "%{$search}%");
            });
        }

        $pasiens = $query->latest()->paginate(5)->withQueryString();

        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'umur' => 'required|integer|min:0|max:150',
            'noHP' => 'required|string|max:20',
        ]);

        Pasien::create($validated);

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan!');
    }

    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'umur' => 'required|integer|min:0|max:150',
            'noHP' => 'required|string|max:20',
        ]);

        $pasien->update($validated);

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus!');
    }
}
