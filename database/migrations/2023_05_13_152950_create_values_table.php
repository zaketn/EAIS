<?php

use App\Models\Tables\Table;
use App\Models\Tables\TableColumn;
use App\Models\Tables\TableRow;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_values', function (Blueprint $table) {
            $table->id();
            $table->text('value');
            $table->foreignIdFor(Table::class);
            $table->foreignIdFor(TableColumn::class);
            $table->foreignIdFor(TableRow::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('values');
    }
};
