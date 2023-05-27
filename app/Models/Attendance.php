<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'status'];
    const STATUS_PRESENT = 'present';
    const STATUS_ABSENT = 'absent';


    public function date(): Attribute
    {
        return new Attribute(
            get: fn ($value) => date('d-m-Y', strtotime($value))
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
