<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property string|array $title
 * @property string|array $description
 * @property string slug
 * @property int $views
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
        'slug'
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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb');
    }

    public function getRouteKeyName(): string
    {
        return preg_match('/api\.(.+?)/', request()->route()->getName()) ?
            'slug' :
            'id';
    }

    public function slug(): Attribute
    {
        return new Attribute(
            set: fn() => Str::slug($this->title)
        );
    }
}
