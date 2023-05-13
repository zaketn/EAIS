<?php

use App\Models\Tables\TableColumn;
use App\Models\Tables\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_columns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);

            $table->unsignedBigInteger('parent_column_id');
            $table->foreign('parent_column_id')->references('id')->on('table_columns');

            $table->foreignIdFor(Table::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {


        Schema::dropIfExists('columns');
    }
};
