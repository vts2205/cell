<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table='transaction';
    protected $fillable=['profile_id','details','amount','from_to','cd_status'];
    public function profile(){
       return $this->belongsTo(Profile::class,'profile_id');
    }
    public function fromTo(){
       return $this->belongsTo(Profile::class,'from_to');
    }
}
