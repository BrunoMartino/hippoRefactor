<?php

namespace App\Http\Controllers;

use App\Models\UsedCoupons;
use Illuminate\Http\Request;
use App\Models\DiscountCoupon;
use App\Services\CouponService;

class UseCouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function getDiscount(Request $request)
    {
        $coupon = DiscountCoupon::where('code', $request->coupon)->first();

        $couponCode = isset($coupon->code) ? $coupon->code : '!@#$##FD';
        $validateCoupon = $this->couponService->validateCoupon($couponCode);
        if ($validateCoupon['error']) :
            return $validateCoupon['response'];
        endif;

        $discount = $this->getDataDiscount($coupon);
        return [
            'status' => 'success',
            'message' => $discount['valueString'] . ' de deconto aplicado.',
            'discount' => $discount
        ];
    }

    public function getDataDiscount($coupon): array
    {
        $discount = [];

        if ($coupon->value) :
            $discount['type'] = 'currency';
            $discount['value'] = $coupon->value;
            $discount['valueString'] = "R$ " . number_format($coupon->value, 2, ',', '.');
        else :
            $discount['type'] = 'percent';
            $discount['value'] = $coupon->percent;
            $discount['valueString'] = "{$coupon->percent}%";
        endif;
        $discount['coupon'] = $coupon->code;

        return $discount;
    }
}
