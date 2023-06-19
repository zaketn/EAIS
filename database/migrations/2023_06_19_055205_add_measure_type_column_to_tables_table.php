<?php

use App\Models\StateSupportMeasure;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->foreignIdFor(StateSupportMeasure::class)
                ->after('description')
                ->nullable()
                ->constrained();

            $table->foreignIdFor(User::class)
                ->after('data')
                ->nullable()
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropForeign('tables_state_support_measure_id_foreign');
            $table->dropColumn('state_support_measure_id');

            $table->dropForeign('tables_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
};
