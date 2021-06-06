<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
    ];

    /**
     * @return HasManyThrough
     */
    public function complexes(): HasManyThrough
    {
        return $this->hasManyThrough(
            Complex::class,
            ComplexCategory::class,
            'category_id',
            'id',
            'id',
            'complex_id');
    }
}
