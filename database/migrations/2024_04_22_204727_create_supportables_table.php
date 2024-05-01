<?php

use App\Models\Rmsp\Support;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supportables', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Support::class);
            $table->integer('supportable_id');
            $table->string('supportable_type'); // регион или тип поддержки

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supportables');
    }
};
