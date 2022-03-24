<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Group;
use App\Models\User;

class Profile extends Model
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
    
    public function myprofile()
    {
        $user_id = Auth::user()->id;   
        return Self::where('user_id',$user_id)->first();
    }
    
    public function guestprofile($id)
    {
        return Self::where('user_id',$id)->first();
    }
    
}
