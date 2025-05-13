<?php

namespace App\Services;

use App\Models\User;
use App\Models\Plano;
use App\Models\UsedCoupons;
use App\Models\Subscription;
use App\Models\CardToken;
use App\Models\CompraUsuario;
use App\Models\PaymentInvoice;
use App\Models\DiscountCoupon;
use App\Models\Invoice;
use App\Models\ControlQuantMessage;
use Illuminate\Http\Request;
use PhpParser\Node\FunctionLike;
use App\Services\ApiLytexService;
use Illuminate\Support\Facades\Log;

class InvoiceService
{

    protected $apiLytex;

    public function __construct(ApiLytexService $apiLytex)
    {
        $this->apiLytex = $apiLytex;
    }


}
