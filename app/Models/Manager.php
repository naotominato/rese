<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Manager extends Authenticatable //Authenticatableが必要
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'shop_id',
        'name',
        'email',
        'password',
    ];

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }
}
