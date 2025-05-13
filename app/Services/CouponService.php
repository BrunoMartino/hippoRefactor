<?php

namespace App\Services;

use App\Models\UsedCoupons;
use App\Models\DiscountCoupon;

class CouponService
{
    public function validateCoupon(String $couponCode): array
    {

        $coupon = DiscountCoupon::where('code', $couponCode)->first();

        // se cupom não for encontrado
        if (is_null($coupon)) :
            return [
                'error' => true,
                'response' => response()->json([
                    'status' => 'error',
                    'message' => 'Cupom não encontrado.',
                ], 404)
            ];
        endif;
        // se cupom foi desativado
        if ($coupon->situation == 'desativado') :
            return [
                'error' => true,
                'response' => response()->json([
                    'status' => 'error',
                    'message' => 'O cupom foi desativado.',
                ], 401)
            ];
        endif;


        // se cupom não tem disponível
        $totalUsados = UsedCoupons::where('cupom_id', $coupon->id)->count();
        if ($totalUsados >= $coupon->qtd_total) :
            return [
                'error' => true,
                'response' => response()->json([
                    'status' => 'error',
                    'message' => 'O cupom não está mais disponível.',
                ], 401)
            ];
        endif;

        // se atingiu o limite de uso por usuário
        $totalUsadosPorUsuario = UsedCoupons::where('cupom_id', $coupon->id)
            ->where('user_id', user_princ())
            ->count();
        if ($totalUsadosPorUsuario >= $coupon->qtd_uso) :
            return [
                'error' => true,
                'response' => response()->json([
                    'status' => 'error',
                    'message' => 'Você já atingiu o limite de uso deste cupom.',
                ], 401)
            ];
        endif;

        if (strtotime(date('Y-m-d')) > strtotime(date($coupon->expiration_date))) :
            return [
                'error' => true,
                'response' => response()->json([
                    'status' => 'error',
                    'message' => 'Cupom expirado.',
                ], 401)
            ];
        endif;

        return [
            'error' => false,
            'response' => null,
        ];
    }
}
