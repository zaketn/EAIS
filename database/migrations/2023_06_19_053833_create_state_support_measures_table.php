<?php

use App\Models\MeasureType;
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
        Schema::create('state_support_measures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('order_number');
            $table->foreignIdFor(MeasureType::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_support_measures');
    }
};
