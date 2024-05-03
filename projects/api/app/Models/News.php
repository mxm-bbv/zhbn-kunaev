<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $title
 * @property string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class News extends Model
{
    use HasFactory,
        HasTranslations;

    public array $translatable = [
        'title',
        'description'
    ];

    protected $casts = [
        'title' => 'json',
        'description' => 'json'
    ];
    protected $fillable = [
        'title',
        'description',
    ];

    protected $guarded = [
        'id'
    ];
}
