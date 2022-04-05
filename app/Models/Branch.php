<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table='branch';
    protected $fillable=['name','address'];
    public function profile(){
        return $this->hasOne(Profile::class,'branch_id');
    }
    
}
