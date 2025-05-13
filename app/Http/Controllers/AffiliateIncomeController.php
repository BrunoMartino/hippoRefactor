<?php

namespace App\Http\Controllers;

use App\Models\AffiliateReferral;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AffiliateIncomeExport;

class AffiliateIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        authorizePermissions(['ver-rend-afiliados']);
        $user = Auth::user();
        $affiliate = $user->affiliate;
        $incomes = AffiliateReferral::where('affiliate_id', $affiliate->id)
            ->latest()
            ->paginate(12);
        return view('pages.affiliate_income.index', compact('incomes'));
    }

    public function exportXlsx()
    {
        return Excel::download(new AffiliateIncomeExport, 'Afiliados ' . date('Y-m-d H.i.s') . '.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new AffiliateIncomeExport, 'Afiliados ' . date('Y-m-d H.i.s') . '.csv', 'Csv');
    }
}
