<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubAdmin extends Model
{
    use HasFactory, HasUuids;
    protected $primaryKey = 'uuid'; 
    public $incrementing = false;
    protected $keyType = 'string';

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }
}
