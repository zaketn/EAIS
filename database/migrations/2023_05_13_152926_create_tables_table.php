<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->text('description');
            $table->date('actuality');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('table_rows', function(Blueprint $table){
            $table->dropForeign('table_rows_table_row_id_foreign');
            $table->dropForeign('table_rows_table_id_foreign');
        });

        Schema::table('table_columns', function(Blueprint $table){
            $table->dropForeign('table_columns_table_column_id_foreign');
            $table->dropForeign('table_columns_table_id_foreign');
        });

        Schema::dropIfExists('tables');
    }
};
