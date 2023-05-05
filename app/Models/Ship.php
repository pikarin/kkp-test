<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ship extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    public function markAsVerified(int $userId): bool
    {
        return $this->forceFill([
            'verified_by' => $userId,
            'status' => 'active',
        ])
            ->save();
    }

    public function markAsRejected(int $userId, string $remarks): bool
    {
        return $this->forceFill([
            'verified_by' => $userId,
            'status' => 'rejected',
            'remarks' => $remarks,
        ])
            ->save();
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeNotActive(Builder $query): Builder
    {
        return $query->where('status', '!=', 'active');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
