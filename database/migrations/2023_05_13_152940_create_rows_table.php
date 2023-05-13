<?php

use App\Models\Tables\TableRow;
use App\Models\Tables\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_rows', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);

            $table->unsignedBigInteger('parent_row_id');
            $table->foreign('parent_row_id')->references('id')->on('table_rows');

            $table->foreignIdFor(Table::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rows');
    }
};
