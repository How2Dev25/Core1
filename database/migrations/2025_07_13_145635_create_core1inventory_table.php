<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('core1_inventory', function (Blueprint $table) {
    $table->id('core1_inventoryID');
    
    // Basic Item Information
    $table->string('core1_inventory_name');
   $table->string('core1_inventory_code')->nullable()->unique();
    $table->text('core1_inventory_description')->nullable();
        
    
    // Category Information
    $table->string('core1_inventory_category'); // e.g., linen, amenities, cleaning supplies
    $table->string('core1_inventory_subcategory')->nullable(); // e.g., under linen: towels, bedsheets
    
    // Stock Information
    $table->integer('core1_inventory_stocks');
    $table->integer('core1_inventory_threshold'); // Minimum stock level before reorder
    $table->string('core1_inventory_unit'); // pcs, kg, liters, rolls, etc.
    
    // Location Information
    $table->string('core1_inventory_location'); // Storage location in hotel
    $table->string('core1_inventory_shelf')->nullable(); // Specific shelf/area
    
    // Supplier Information
    $table->string('core1_inventory_supplier')->nullable();
    $table->string('core1_inventory_supplier_contact')->nullable();
    
    // Additional Details
    $table->decimal('core1_inventory_cost', 10, 2)->nullable(); // Per unit cost
    $table->string('core1_inventory_image')->nullable(); // Path to image
    
    // Status and Tracking
    $table->boolean('core1_inventory_active')->default(true);
    $table->timestamp('core1_inventory_last_restocked')->nullable();
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_inventory');
    }
};
