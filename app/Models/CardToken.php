<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CardToken extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'card_tokens';

    protected $fillable = [
        'user_id',
        'card_token_id',
        'card_number',
        'brand',
        'status',
    ];

    protected $appends = [
        'url_brand'
    ];

    public function getUrlBrandAttribute()
    {
        $url = null;

        switch ($this->brand) {
            case 'Visa':
                $url = asset('assets/images/cards/visa.png');
                break;

            case 'Master':
                $url = asset('assets/images/cards/mastercard.png');
                break;

            case 'Diners':
                $url = asset('assets/images/cards/diners-club.png');
                break;

            case 'Amex':
                $url = asset('assets/images/cards/am_amex.png');
                break;

            case 'JCB':
                $url = asset('assets/images/cards/jcb.png');
                break;

            case 'Discover':
                $url = asset('assets/images/cards/discover.png');
                break;

            case 'Hipercard':
                $url = asset('assets/images/cards/hipercard.png');
                break;
            default:
                $url = asset('assets/images/cards/credit-card.svg');
                break;
        }

        return $url;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
