<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicPromoMessage extends Model
{
    use HasFactory;
    protected $table = 'public_promo_message';
    protected $fillable = ['id','message','url'];

}
