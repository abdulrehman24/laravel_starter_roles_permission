<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory,HasUuids;
    protected $primaryKey = 'uuid'; 
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [
    //     'user_id', 'team_id', 'name', 'position', 'statistic_data'
    // ];
    protected $guarded = [];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_uuid', 'uuid');
    }

    public function statistics()
    {
        return $this->hasMany(Statistic::class, 'player_uuid', 'uuid');
    }
}
