<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * @property int    $id
 * @property string|array $title
 * @property string|array $description
 * @property int    $views
 * @property string $status
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Article extends Model implements HasMedia
{
    use HasFactory,
        HasTranslations,
        InteractsWithMedia,
        SoftDeletes;

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
        'views',
        'status',
    ];

    protected $guarded = [
        'id'
    ];

    public function delete(): ?bool
    {
        $this->update(['status' => 'archived']);

        return parent::delete();
    }

    public function restore(): bool
    {
        $this->update(['status' => 'drafts']);

        return self::restore();
    }
}
