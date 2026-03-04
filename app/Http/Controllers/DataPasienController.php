<?php

namespace App\Http\Controllers;

use App\Models\DataPasien;
use Illuminate\Http\Request;

class DataPasienController extends Controller
{
    public function index()
    {
        $dataPasien = DataPasien::latest()->paginate(10);
        return view('pasien.index', compact('dataPasien'));
    }

    public function dashboard()
    {
        $recentPatients = DataPasien::latest()->take(5)->get();
        $totalPatients = DataPasien::count();
        $avgAge = DataPasien::avg('umur');
        $youngest = DataPasien::min('umur');
        $oldest = DataPasien::max('umur');
        
        return view('dashboard', compact('recentPatients', 'totalPatients', 'avgAge', 'youngest', 'oldest'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:data-pasien,nik',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'riwayat_penyakit' => 'nullable|string',
            'alergi' => 'nullable|string',
        ]);

        DataPasien::create($request->all());

        return redirect()->route('data-pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function show(DataPasien $dataPasien)
    {
        return view('pasien.show', compact('dataPasien'));
    }

    public function edit(DataPasien $dataPasien)
    {
        return view('pasien.edit', compact('dataPasien'));
    }

    public function update(Request $request, DataPasien $dataPasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:data-pasien,nik,' . $dataPasien->id,
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'email' => 'nullable|email|max:255',
            'golongan_darah' => 'nullable|in:A,B,AB,O',
            'riwayat_penyakit' => 'nullable|string',
            'alergi' => 'nullable|string',
        ]);

        $dataPasien->update($request->all());

        return redirect()->route('data-pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(DataPasien $dataPasien)
    {
        $dataPasien->delete();

        return redirect()->route('data-pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
