<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name','manager_id','deadline'];

    public function user(){
        return $this->hasOne(User::class);
    }
   
}
