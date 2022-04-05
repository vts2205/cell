<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table='profile';
    protected $fillable=['name','phone','place','address','image','branch_id','current_position','user_id','image'];
    public function user(){
       return $this->hasOne(User::class);
    }
    public function transactions(){
       return $this->hasMany(Transactions::class);
    }
    // public function fromTo(){
    //    return $this->hasMany(Transactions::class,'from_to');

    // }
    public function branch(){
       return $this->belongsTo(Branch::class);
    }
    public function accounts(){
       return $this->hasMany(Account::class);
    }
}
