<?php

use App\Models\Rmsp\SupportForm;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('support_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignIdFor(SupportForm::class)->constrained();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('support_types');
    }
};
