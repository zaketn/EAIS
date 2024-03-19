<?php

use App\Models\Rmsp\CompanyType;
use App\Models\Rmsp\Region;
use App\Models\Rmsp\SupportUnitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistic_by_regions', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Region::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CompanyType::class)->constrained();
            $table->dateTime('date_of_support');
            $table->unsignedBigInteger('amount');


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistic_by_regions');
    }
};
