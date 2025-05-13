<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as UserAuthenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Nivel;
use Spatie\Permission\Traits\HasRoles;

class User extends UserAuthenticatable
{
    use HasFactory, SoftDeletes, Notifiable, HasRoles;

    protected $fillable = [
        'tipo_usuario',
        'email',
        'nome_usuario',
        'razao_social',
        'foto_perfil',
        'cpf',

        'cnpj',
        'endereco',
        'bairro',
        'cidade',
        'estado',

        'whatsapp',
        'password',
        'digitos_confirmacao',
        'cadastrado_por',
        'status',
        'plano_id',
        'nivel_id',
        'aceite',
        'beta_user'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $appends = [
        'url_foto_perfil'
    ];

    public function getUrlFotoPerfilAttribute($value)
    {
        return is_null($this->foto_perfil) ? asset('assets/images/profile/perfil-vazio.png') : asset($this->foto_perfil);
    }

    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'id', 'nivel_id');
    }

    public function plano()
    {
        return $this->hasOne(Plano::class, 'id', 'plano_id');
    }

    public function subscription()
    {
        $sub = $this->hasMany(Subscription::class);
        return  $sub->orderBy('created_at', 'desc')
            ->first();
    }

    public function subscriptionAll()
    {
        return $this->hasMany(Subscription::class);
    }

    public function affiliate()
    {
        return $this->hasOne(Affiliate::class);
    }

    public function affiliate_ref()
    {
        return $this->hasOne(AffiliateReferral::class);
    }

    public function cadastradoPor()
    {
        return $this->hasMany(User::class, 'id', 'cadastrado_por');
    }

    public function messageReports()
    {
        return $this->hasMany(MessageReport::class);
    }

    public function controlQuantMessage()
    {
        return $this->hasOne(ControlQuantMessage::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

