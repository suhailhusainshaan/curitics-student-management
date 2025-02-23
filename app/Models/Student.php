<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

        /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'roll_number',
        'class',
        'dob',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
