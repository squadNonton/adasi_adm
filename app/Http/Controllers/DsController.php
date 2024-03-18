<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Handling;
use Carbon\Carbon;

class DsController extends Controller
{
    //
    public function dashboardHandling()
    {
        // Mendapatkan data dari database berdasarkan tahun ini pada kolom created_at dan status 3
        $claimData = Handling::whereYear('created_at', date('Y'))
        ->where('type_1', 'Claim')
        ->where('status', 3) // Menambahkan kondisi untuk status bernilai 3
        ->get(['created_at'])
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        })
        ->map(function ($item) {
            return count($item);
        })
        ->toArray();

        $complainData = Handling::whereYear('created_at', date('Y'))
        ->where('type_1', 'Complain')
        ->where('status', 3) // Menambahkan kondisi untuk status bernilai 3
        ->get(['created_at'])
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        })
        ->map(function ($item) {
            return count($item);
        })
        ->toArray();
        // Menambahkan consol log
        // dd($claimData, $complainData);
        // // Mengirimkan data ke view
        return view('dashboard.dashboardHandling', compact('complainData'));
    }

   

}
