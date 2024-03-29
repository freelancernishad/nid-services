<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'nidbalance',
        'name',
        'role',
        'email',
        'password',
        'type',
        'status',
        'referral_commissions',
        'balance',

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


    public function roles(){
        return $this->belongsTo(Role::class, 'role', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'userid');
    }

     // Relationship: Each user has a parent (referrer)
     public function parent()
     {
         return $this->belongsTo(User::class, 'parent_id');
     }

     // Relationship: Each user has many children (downlines)
     public function children()
     {
         return $this->hasMany(User::class, 'parent_id');
     }

     // Logic to add a child (downline) to a user
     public function addChild(User $child)
     {
         $child->parent_id = $this->id;
         $child->level = $this->level + 1;
         $child->save();

         if (!$this->left_leg) {
             $this->left_leg = $child->id;
         } elseif (!$this->right_leg) {
             $this->right_leg = $child->id;
         }

         $this->save();
     }


}
