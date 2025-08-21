<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
   use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function subscriber():HasOne
    {
         return $this->hasOne(Subscriber::class );
    }
    public function contributions():HasMany{
        return $this->hasMany(Contribution::class);
    }
    public function roles():BelongsToMany{
        return $this->belongsToMany(Role::class)->withPivot('status')->withTimestamps();
    }
    public function hasRole(string $roleName):bool{
         return $this->roles->contains('name',$roleName);
    }
    public function comments():HasMany{
        return $this->hasMany(Comment::class);
    }
    public function news():HasMany{
        return $this->hasMany(News::class);
    }
}
