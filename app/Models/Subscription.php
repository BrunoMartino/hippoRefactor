<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'data_change',
        'data_cancel',
        'cupom_id',
        'valor_plano',
        'coupon_id'
    ];

    protected $appends = [
        'expiration_date',
        'days_expire',
        'expiration_date_paid_plan',
        'days_expire_paid_plan',
    ];

    // Obter expiração para planos gratuitos
    function getExpirationDateAttribute()
    {
        if ($this->plan_id != 4 && $this->plan_id != 8 && $this->plan_id != 12 && $this->plan_id != 16) // plano gratuito
            return null;

        return date('Y-m-d H:i', strtotime($this->created_at->format('Y-m-d H:i') . " + 7 days"));
    }

    // Obter expiração para planos pagos
    function getExpirationDatePaidPlanAttribute()
    {
        if (!in_array($this->plan_id, [4, 8, 12, 16])) {

            $dateAt = $this->created_at->format('Y-m-d');

            $dateExp = date('Y-m-15', strtotime($dateAt));
            $dateExp = date('Y-m-15', strtotime($dateExp . " + 1 months"));
            $lastDayMont = date('t', strtotime($dateExp));

            // se a da de compra for dia 31 de um mês, por exeplo Jan, o proximo mes Fev o ultimo dia é 28
            // Ou seja, vai tornar o ultimo dia de vencimento em 28 de Fev e não somando mais +1 mes, q o php entendi
            // q se somar dia 31 de Jan + 1 mes, vai dar no dia +ou- dia 2 de MAI
            // para evitar isso tem esses calculos

            if (date('t', strtotime($dateAt)) > $lastDayMont && date('d', strtotime($dateAt)) != date('d', strtotime($dateAt . " + 1 months"))):
                $expireDateEnd = date("Y-m-$lastDayMont", strtotime($dateExp));
            else:
                $expireDateEnd = date("Y-m-d", strtotime($dateAt . " + 1 months"));
            endif;

            return $expireDateEnd;
        } else {
            return null;
        }

        return null;
    }

    // dias para expirar plano gratuito
    function getDaysExpireAttribute()
    {
        if ($this->plan_id != 4 && $this->plan_id != 8 && $this->plan_id != 12 && $this->plan_id != 16) // plano gratuito
            return null;

        $origin = new \DateTimeImmutable(date('Y-m-d'));
        $target = new \DateTimeImmutable(date('Y-m-d', strtotime($this->created_at->format('Y-m-d H:i') . " + 7 days")));
        $interval = $origin->diff($target);

        if ($interval->format('%R') == '+' && $interval->format('%a') != '0') :
            if ($interval->format('%a') == 1)
                return $interval->format('%a dia');
            return $interval->format('%a dias');
        else :
            return 'Expirado';
        endif;
    }

    // dias para expirar plano pago
    function getDaysExpirePaidPlanAttribute()
    {
        if (!in_array($this->plan_id, [4, 8, 12, 16])) {

            $dateAt = $this->created_at->format('Y-m-d');
            $dateToday = date('Y-m-d');


            $dateExp = date('Y-m-15', strtotime($dateAt));
            $dateExp = date('Y-m-15', strtotime($dateExp . " + 1 months"));
            $lastDayMont = date('t', strtotime($dateExp));

            // se a da de compra for dia 31 de um mês, por exeplo Jan, o proximo mes Fev o ultimo dia é 28
            // Ou seja, vai tornar o ultimo dia de vencimento em 28 de Fev e não somando mais +1 mes, q o php entendi
            // q se somar dia 31 de Jan + 1 mes, vai dar no dia +ou- dia 2 de MAI
            // para evitar isso tem esses calculos
            // dd(date('t', strtotime($dateAt)), $lastDayMont, date('d', strtotime($dateAt)), date('d', strtotime($dateAt." + 1 months")));

            if (date('t', strtotime($dateAt)) > $lastDayMont && date('d', strtotime($dateAt)) != date('d', strtotime($dateAt . " + 1 months"))):
                $expireDateEnd = date("Y-m-$lastDayMont", strtotime($dateExp));
            else:
                $expireDateEnd = date("Y-m-d", strtotime($dateAt . " + 1 months"));
            endif;

            $createdAt = new \DateTimeImmutable($expireDateEnd);
            $today = new \DateTimeImmutable($dateToday);

            $interval = $today->diff($createdAt);

            if ($interval->invert === 0 && $interval->days >= 0) {
                return $interval->days === 1 ? '+1 dia' : '+' . $interval->days . ' dias';
            } else {
                return 'Expirado';
            }
        } else {
            return null;
        }
    }

    public function plan()
    {
        return $this->belongsTo(Plano::class, 'plan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(DiscountCoupon::class);
    }
}
