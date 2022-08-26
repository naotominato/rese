<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'detail',
        'image_url',
    ];

    protected $guarded =['id'];

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function favorite()
    {
        
        return $this->hasmany('App\Models\Favorite');
    }

    public function reserve()
    {
        return $this->hasmany('App\Models\Reserve');
    }

    public function review()
    {
        return $this->hasmany('App\Models\Review');
    }

    public function manager()
    {
        return $this->hasmany('App\Models\Manager');
    }

    public function isfavoritedBy($user_id): bool {
        return Favorite::where('user_id', $user_id)->where('shop_id', $this->id)->first() !==null;
    }

    public function managerShop()
    {
        return Manager::where('shop_id', $this->id)->first();
    }

    public function reserved($shop_id)
    {
        return Reserve::where('shop_id', $shop_id)->first();
        //予約一覧　作成中
    }
}
