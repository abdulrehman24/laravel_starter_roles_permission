<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FixtureSession extends Model
{
    use HasUuids,HasFactory;
    protected $primaryKey = 'uuid'; 
    public $incrementing = false;
    protected $keyType = 'string';
    // protected $fillable = [
    //     'name', 'club_id', 'status'
    // ];
    protected $guarded = [];
    // Relationships
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_uuid', 'uuid');
    }

    public function fixtureEvents()
    {
        return $this->hasMany(FixtureEvent::class, 'fixture_session_uuid', 'uuid');
    }
}
