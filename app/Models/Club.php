<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends Model
{
    use HasUuids, HasFactory;
    protected $primaryKey = 'uuid'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_uuid', 'uuid');
    }

    public function teams()
    {
        return $this->hasMany(Team::class,'club_uuid', 'uuid');
    }

    public function fixtureSession()
    {
        return $this->hasMany(FixtureSession::class, 'club_uuid', 'uuid');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'club_uuid', 'uuid');
    }
    
}
