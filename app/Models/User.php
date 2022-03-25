<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function admin()
    {
     return $this->hasMany(Group::class)->orderBy('updated_at', 'desc');
    }
    
    public function mygroups()
    {
     $user_id = Auth::user()->id;    
     return $this->belongsToMany(Group::class)->wherePivot('user_id',$user_id)->orderBy('updated_at', 'desc');
    }
    
    public function groups()
    {
     return $this->belongsToMany(Group::class)->withTimestamps();
    }
    
    public function posts()
    {
     return $this->belongsToMany(Post::class)->withTimestamps();
    }
    
    public function profile()
    {
      return $this->hasOne(Profile::class);
    }
    
    public function my_posts()
    {
     return $this->hasMany(Post::class)->orderBy('updated_at', 'desc');
    }
    
    public function my_questions()
    {
     return $this->hasMany(Question::class)->orderBy('updated_at', 'desc');
    }
    
}
