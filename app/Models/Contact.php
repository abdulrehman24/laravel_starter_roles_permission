<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasUuids,HasFactory;
    protected $primaryKey = 'uuid'; 
    public $incrementing = false;
    protected $keyType = 'string';
    //
    protected $fillable = [
        'user_id', 'name', 'email', 'phone'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid','uuid');
    }

}
