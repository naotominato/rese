<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserve_id',
        'evaluation',
        'comment',
    ];

    protected $guarded = ['id'];

    public function reserve()
    {
        return $this->belongsTo('App\Models\Reserve');
    }
}
