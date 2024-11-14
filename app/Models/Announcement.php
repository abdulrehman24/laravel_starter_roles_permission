<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory,HasUuids;

    // protected $fillable = [
    //     'vendor_id', 'admin_id', 'content'
    // ];

    protected $guarded = [];

    // Relationships
    public function clubs()
    {
        return $this->belongsTo(Club::class, 'club_uuid', 'uuid');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
