<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Furniture extends Model
{
    /** @use HasFactory<\Database\Factories\FurnitureFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity'
    ];

    /**
     * Filter for availability
     * 
     * @param Builder $sql
     * @return Builder
     */
    public function scopeAvailable(Builder $sql): Builder
    {
        return $sql->where('quantity', '>', 0);
    }

    /**
     * Filter for price greater than
     * 
     * @param Builder $sql
     * @param Int $price
     * @return Builder
     */
    public function scopePriceGT(Builder $sql, int $price): Builder
    {
        return $sql->where('price', '>=', $price);
    }

    /**
     * Filter for price lower than
     * 
     * @param Builder $sql
     * @param Int $price
     * @return Builder
     */
    public function scopePriceLT(Builder $sql, int $price): Builder
    {
        return $sql->where('price', '<=', $price);
    }
}
