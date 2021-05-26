<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','origin','category','type','price','description','image'];
    
    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('id','desc');
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favourites(){
        return $this->hasMany(Favourite::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
