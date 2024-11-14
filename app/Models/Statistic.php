<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statistic extends Model
{
    use HasFactory,HasUuids;
    protected $primaryKey = 'uuid'; 
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    // RelationshipsP
    public function fixtureEvent()
    {
        return $this->belongsTo(FixtureEvent::class, 'fixture_event_uuid','uuid');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_uuid', 'uuid');
    }
 
}
