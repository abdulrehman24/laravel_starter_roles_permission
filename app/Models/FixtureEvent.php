<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FixtureEvent extends Model
{
    use HasFactory,HasUuids;
    protected $primaryKey = 'uuid'; 
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [
    //     'fixture_session_id', 'team_1_id', 'team_2_id', 'location', 'scheduled_time'
    // ];

    protected $guarded = [];

    // Relationships
    public function fixturesession()
    {
        return $this->belongsTo(FixtureSession::class,'fixture_session_uuid','uuid');
    }

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_1_uuid', 'uuid');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_2_uuid','uuid');
    }

    public function statistics()
    {
        return $this->hasMany(Statistic::class, 'fixture_event_uuid','uuid');
    }
}
