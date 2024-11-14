<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'vendor_id',
        'name',
        'sport_type'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function clubs()
    {
        return $this->belongsTo(Club::class, 'club_uuid', 'uuid');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'team_uuid', 'uuid');
    }

    public function fixtureEventsTeam1()
    {
        return $this->hasMany(FixtureEvent::class, 'team_1_uuid', 'uuid');
    }

    public function fixtureEventsTeam2()
    {
        return $this->hasMany(FixtureEvent::class, 'team_2_uuid', 'uuid');
    }
}
