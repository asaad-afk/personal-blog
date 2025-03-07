<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = ["title","content","image"];
    public function likes(){
        return $this->hasMany(Like::class)->where("like",true);
    }
    public function dislikes(){
        return $this->hasMany(Like::class)->where("like",false);
    }
}
