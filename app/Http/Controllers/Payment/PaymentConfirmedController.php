<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentConfirmedController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:usuario_princ']);
        $this->middleware(['check_payment']);
    }

    public function index()
    {
        return view('pages.payment.confirmed.index');
    }
}
