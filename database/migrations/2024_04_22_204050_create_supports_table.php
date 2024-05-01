<?php

use App\Models\Rmsp\CompanyType;
use App\Models\Rmsp\ImportedFile;
use App\Models\Rmsp\SupportUnitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(SupportUnitType::class)->constrained();
            $table->foreignIdFor(CompanyType::class)->constrained();
            $table->dateTime('date');
            $table->double('amount');
            $table->foreignIdFor(ImportedFile::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
