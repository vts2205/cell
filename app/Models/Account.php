<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table='account';
    protected $fillable=['profile_id','details'];
    public function profile(){
       return $this->belongsTo(Profile::class,'profile_id');
    }
}
