<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Syncable;

class Inventory extends Model
{
    use HasFactory, Syncable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'core1_inventory';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'core1_inventoryID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'core1_inventoryID',
        'core1_inventory_name',
        'core1_inventory_code',
        'core1_inventory_description',
        'core1_inventory_category',
        'core1_inventory_subcategory',
        'core1_inventory_stocks',
        'core1_inventory_threshold',
        'core1_inventory_unit',
        'core1_inventory_location',
        'core1_inventory_shelf',
        'core1_inventory_supplier',
        'core1_inventory_supplier_contact',
        'core1_inventory_cost',
        'core1_inventory_image',
        'core1_inventory_active',
        'core1_inventory_last_restocked'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'core1_inventory_cost' => 'decimal:2',
        'core1_inventory_active' => 'boolean',
        'core1_inventory_last_restocked' => 'datetime',
    ];

    /**
     * Get the validation rules that apply to the model.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'core1_inventory_name' => 'required|string|max:255',
            'core1_inventory_code' => 'required|string|max:255|unique:core1_inventory',
            'core1_inventory_category' => 'required|string|max:255',
            'core1_inventory_stocks' => 'required|integer|min:0',
            'core1_inventory_threshold' => 'required|integer|min:1',
            'core1_inventory_unit' => 'required|string|max:50',
            'core1_inventory_location' => 'required|string|max:255',
            'core1_inventory_cost' => 'nullable|numeric|min:0',
            'core1_inventory_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Scope a query to only include active inventory items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('core1_inventory_active', true);
    }

    /**
     * Scope a query to only include items below threshold.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNeedsRestocking($query)
    {
        return $query->whereColumn('core1_inventory_stocks', '<=', 'core1_inventory_threshold');
    }

    /**
     * Get the formatted cost attribute.
     *
     * @return string
     */
    public function getFormattedCostAttribute()
    {
        return $this->core1_inventory_cost ? '₱' . number_format($this->core1_inventory_cost, 2) : 'N/A';
    }

    /**
     * Check if the item needs restocking.
     *
     * @return bool
     */
    public function needsRestocking()
    {
        return $this->core1_inventory_stocks <= $this->core1_inventory_threshold;
    }
}