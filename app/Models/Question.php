<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
     protected $guarded = [
      'id',
      'created_at',
      'updated_at',
    ];
    
    public function user()
    {
     return $this->belongsTo(User::class);
    }
    
    public function all_answers()
    {
     return $this->hasMany(Answer::class)->orderBy('updated_at', 'desc');
    }
 
}


