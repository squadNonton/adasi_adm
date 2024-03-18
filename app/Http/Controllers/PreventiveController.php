<?php

namespace App\Http\Controllers;

use App\Models\Preventive;
use App\Models\Mesin;
use App\Models\DetailPreventive;
use Illuminate\Http\Request;

class PreventiveController extends Controller
{
    public function maintenanceDashPreventive()
    {
        // Mengambil semua data Mesin
        $mesins = Mesin::latest()->get();
        // Mengambil semua data Preventive
        $detailpreventives = DetailPreventive::latest()->get();
        // Variabel $i didefinisikan di sini
        $i = 0;
        // Kembalikan view dengan data mesins, preventives, dan $i
        return view('maintenance.dashpreventive', compact('mesins', 'detailpreventives', 'i'));
    }

    public function maintenanceDashBlockPreventive()
    {
        // Mengambil semua data Mesin
        $mesins = Mesin::latest()->get();

        // Mengambil semua data Preventive
        $detailpreventives = DetailPreventive::latest()->get();

        // Variabel $i didefinisikan di sini
        $i = 0;

        // Kembalikan view dengan data mesins, preventives, dan $i
        return view('maintenance.blokpreventive', compact('mesins', 'detailpreventives', 'i'));
    }

    public function deptmtceDashPreventive()
    {
        $mesins = Mesin::latest()->get();
        return view('deptmtce.dashpreventive', compact('mesins'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function EditDeptMTCEPreventive(Mesin $mesin, DetailPreventive $detailPreventive)
    {
        $detailPreventives = DetailPreventive::where('id_mesin', $mesin->id)
            ->select('perbaikan_checked', 'perbaikan') // Memilih kolom perbaikan_checked dan perbaikan
            ->get();

        $mesins = Mesin::latest()->get();
        // Mendapatkan status mesin
        $status = $mesin->status;

        // Tentukan tampilan berdasarkan status
        if ($status == 1 || $status == 0) {
            return view('deptmtce.lihatpreventive', compact('mesin', 'mesins', 'detailPreventives'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return view('deptmtce.dashpreventive', compact('mesins'))->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    public function EditMaintenancePreventive(Mesin $mesin, DetailPreventive $detailPreventive)
    {
        $detailPreventives = DetailPreventive::where('id_mesin', $mesin->id)
            ->select('perbaikan_checked', 'perbaikan') // Memilih kolom perbaikan_checked dan perbaikan
            ->get();

        $mesins = Mesin::latest()->get();
        // Mendapatkan status mesin
        $status = $mesin->status;
        // Determine view based on status
        if ($status === 1) {
            return view('maintenance.lihatpreventive', compact('mesin', 'mesins', 'detailPreventives'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else if ($status === 0) {
            return view('maintenance.editpreventive', compact('mesin', 'mesins', 'detailPreventives'))->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return view('maintenance.dashpreventive', compact('mesins'))->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }
}
