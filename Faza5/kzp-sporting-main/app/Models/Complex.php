<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Complex extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'complexes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'images',
        'logo',
        'content',
        'moderator_id',
    ];

    /**
     * @param $value
     * @return mixed
     */
    public function getImagesAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * @param $value
     */
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = serialize($value);
    }

    public function getAverageRatingAttribute()
    {
        $averageRating = 0;

        if ($this->courts->count() > 0) {
            foreach ($this->courts as $court) {
                $averageRating += $court->rating;
            }
            $averageRating = $averageRating / $this->courts->count();
        }

        return $averageRating;
    }

    /**
     * @return BelongsTo
     */
    public function moderator(): BelongsTo
    {
        return $this->belongsTo(Moderator::class);
    }

    /**
     * @return HasMany
     */
    public function workingHours(): HasMany
    {
        return $this->hasMany(WorkingHour::class);
    }

    /**
     * @return HasMany
     */
    public function courts(): HasMany
    {
        return $this->hasMany(Court::class);
    }

    /**
     * @return HasManyThrough
     */
    public function categories(): HasManyThrough
    {
        return $this->hasManyThrough(
            Category::class,
            ComplexCategory::class,
            'complex_id',
            'id',
            'id',
            'category_id');
    }
}
