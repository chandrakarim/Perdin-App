<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\City;
use App\Models\Perdin;
use Illuminate\Http\Request;
use App\Helpers\PerdinHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PerdinController extends Controller
{
    public function index()
    {
        $perdins = Perdin::with(['fromCity', 'toCity'])
            ->where('user_id', Auth::id()) // hanya milik pegawai login
            ->latest()
            ->get();

        return view('pegawai.dashboard', compact('perdins'));
    }

    public function create()
    {

        $cities = City::all(); // ambil semua kota

        return view('pegawai.perdin.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_city_id' => 'required',
            'to_city_id' => 'required',
            'purpose' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $asal = City::findOrFail($request->from_city_id);
        $tujuan = City::findOrFail($request->to_city_id);

        // Hitung jarak
        $jarak = PerdinHelper::hitungJarak($asal->latitude, $asal->longitude, $tujuan->latitude, $tujuan->longitude);

        // Hitung jumlah hari perjalanan
        $hari = (new \DateTime($request->start_date))->diff(new \DateTime($request->end_date))->days + 1;

        // Hitung uang saku
        $uangSaku = PerdinHelper::hitungUangSaku($asal, $tujuan, $jarak);

        // Pastikan integer supaya DB menyimpan penuh
        $daily = $uangSaku['amount'];
        $total = $daily * $hari;

        Perdin::create([
            'user_id' => Auth::id(),
            'from_city_id' => $asal->id,
            'to_city_id' => $tujuan->id,
            'purpose' => $request->purpose,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'duration_days' => $hari,
            'distance_km' => round($jarak, 2),
            'daily_allowance' => $daily,
            'total_allowance' => $total,
        ]);

        return redirect()->route('pegawai.dashboard')
            ->with('success', 'Perjalanan dinas berhasil diajukan.');
    }

    // SDM melihat semua perdin pending
    public function indexSdm()
    {
        $perdins = Perdin::with(['user', 'fromCity', 'toCity'])
            ->where('status', 'pending')
            ->get();

        return view('sdm.dashboard', compact('perdins'));
    }

    public function indexhistory()
    {
        $perdins = Perdin::with(['user', 'fromCity', 'toCity'])
            ->whereIn('status', ['approved', 'rejected'])
            ->where('approved_by', Auth::id()) // tambahkan ini
            ->orderByDesc('created_at')
            ->get();

        //dd($perdins);
        return view('sdm.history', compact('perdins'));
    }


    // Approve Perdin
    public function approve($id)
    {
        $perdin = Perdin::findOrFail($id);
        $perdin->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'notes' => 'Disetujui oleh SDM',
        ]);

        return redirect()->back()->with('success', 'Perdin disetujui');
    }

    // Reject Perdin
    public function reject(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required|string|max:255',
        ]);

        $perdin = Perdin::findOrFail($id);
        $perdin->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('error', 'Perdin ditolak');
    }
}
