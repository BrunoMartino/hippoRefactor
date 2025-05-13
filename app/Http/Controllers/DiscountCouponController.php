<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCoupon;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;

class DiscountCouponController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('role:super_admin|admin', ['except' => []]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        authorizePermissions(['ver-cupons']);

        $coupons = $this->filter($request)->latest()->paginate(10);
        return view('pages.coupons.index', compact('coupons'));
    }

    public function filter($request)
    {
        $coupons = DiscountCoupon::where('id', '>', 0);

        if ($request->has('nome') && $request->nome != '') :
            $coupons->where('id', $request->nome);
        endif;
        if ($request->has('valor') && $request->valor != '') :
            $coupons->where('value', str_replace(['.', ','], ['', '.'], $request->valor));
        endif;
        if ($request->has('porc') && $request->porc != '') :
            $coupons->where('percent', $request->porc);
        endif;
        if ($request->has('cod') && $request->cod != '') :
            $coupons->where('code', $request->cod);
        endif;

        if ($request->has('dt_val_min') && $request->dt_val_min != '') :
            $coupons->whereBetween('expiration_date', [$request->dt_val_min . ' 00:00', '2099-01-01']);
        endif;
        if ($request->has('dt_val_max') && $request->dt_val_max != '') :
            $coupons->whereBetween('expiration_date', ['1970-01-01', $request->dt_val_max . ' 23:59:59']);
        endif;

        if ($request->has('t') && $request->t == 1) :
            $coupons->whereIn('situation', ['ativo', 'desativado']);
        else :
            if ($request->has('s1') && $request->s1 != '') :
                $coupons->where('situation', 'ativo');
            endif;

            if ($request->has('s2') && $request->s2 != '') :
                $coupons->where('situation', 'desativado');
            endif;
        endif;

        if ($request->has('re1') && $request->re1 == 'sim' && $request->has('re2') && $request->re2 == 'nao') :
            $coupons->whereIn('occurrence', ['sim', 'nao']);
        else :
            if ($request->has('re1') && $request->re1 != '') :
                $coupons->where('occurrence', 'sim');
            endif;

            if ($request->has('re2') && $request->re2 != '') :
                $coupons->where('occurrence', 'nao');
            endif;
        endif;


        // utilizados
        if ($request->has('ut1') && $request->ut1 != '') :
            $coupons->whereHas('used_coupons');
        endif;

        if ($request->has('ut2') && $request->ut2 != '') :
            $coupons->doesntHave('used_coupons');
        endif;

        return $coupons;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        authorizePermissions(['criar-cupons']);
        return view('pages.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStoreRequest $request)
    {
        /* TODO: inserir regra de negócio/autorizações */

        authorizePermissions(['criar-cupons']);

        if ($request->value != '')
            $request['percent'] = null;
        if ($request->percent != '')
            $request['value'] = null;

        $coupon = (new DiscountCoupon)->fill($request->all());
        $coupon->save();

        return redirect()->route('coupons.index')->withSuccess('Cupom adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountCoupon $coupon)
    {
        return view('pages.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountCoupon $coupon)
    {
        // authorizePermissions(['edi-cupons']);
        return view('pages.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponUpdateRequest $request, DiscountCoupon $coupon)
    {

        /* TODO: inserir regra de negócio/autorizações */

        // authorizePermissions(['edi-cupons']);

        if ($request->value != '')
            $request['percent'] = null;
        if ($request->percent != '')
            $request['value'] = null;

        $coupon = $coupon->fill($request->all());
        $coupon->save();

        return redirect()->route('coupons.index')->withSuccess('Cupom atualizado com sucesso!');
    }

    public function activate(DiscountCoupon $coupon)
    {
        authorizePermissions(['ativar-desativar-cupons']);
        $coupon->situation = 'ativo';
        $coupon->save();
        return redirect()->back()->withSuccess('Cupom ativado com sucesso!');
    }

    public function disable(DiscountCoupon $coupon)
    {
        authorizePermissions(['ativar-desativar-cupons']);
        $coupon->situation = 'desativado';
        $coupon->save();
        return redirect()->back()->withSuccess('Cupom desativado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountCoupon $coupon)
    {
        /* TODO: inserir regra de negócio/autorizações */

        authorizePermissions(['deletar-cupons']);
        $coupon->delete();
        return redirect()->back()->withSuccess('Cupom deletado com sucesso!');
    }
}
