<?php

declare(strict_types=1);

namespace App\Task\Domain;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

final class Task extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'immutable_datetime',
        ];
    }
}
