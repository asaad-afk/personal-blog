<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Response;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ["blog_id","user_id","like"];


    public function blog(){
        return $this->belongsTo( Blog::class);
    }
    
    public function user(){
        return $this->belongsTo( User::class);
    }
}
