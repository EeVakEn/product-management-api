<?php

namespace App\Models;

use Cassandra\Cluster\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'category', 'in_stock'
    ];

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('in_stock', true);
    }
}
