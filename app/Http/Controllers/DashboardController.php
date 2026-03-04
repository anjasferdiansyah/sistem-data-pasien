<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $patients = Pasien::all();

        $stats = [
            'totalPatients' => $patients->count(),
            'avgAge' => $patients->count() > 0 ? round($patients->avg('umur')) : 0,
            'youngest' => $patients->count() > 0 ? $patients->min('umur') : 0,
            'oldest' => $patients->count() > 0 ? $patients->max('umur') : 0,
        ];

        $recentPatients = Pasien::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentPatients'));
    }
}
