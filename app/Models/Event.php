<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    use SoftDeletes;

    // custom column for soft delete
    const DELETED_AT = 'deletedAt';

    // to return id as uuid
    public $incrementing = false;

    // disable auto update timestamp
    public $timestamps = false;

    // enable mass assignments
    protected $guarded = ['id'];

    /**
     * Boot config
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $model) {
            $model->id        = (string) Str::uuid();
            $model->createdAt = now()->toDateTimeString();
            $model->updatedAt = now()->toDateTimeString();
        });
    }
}
