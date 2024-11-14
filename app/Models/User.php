<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles,HasUuids;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'uuid'; // Set 'uuid' as the primary key
    public $incrementing = false;    // Disable auto-incrementing
    protected $keyType = 'string';   // Set key type as string
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
    public function userable(): MorphTo{
        return $this->morphTo();
    }
    // Relationships
    public function clubs()
    {
        return $this->hasMany(Club::class, 'user_uuid', 'uuid');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'user_uuid', 'uuid');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'user_uuid', 'uuid');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'admin_uuid', 'uuid');
    }
}
