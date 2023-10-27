<?php

use App\Models\CalculatorParameterTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calculator_parameter_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });

        CalculatorParameterTypes::query()->insert([
            [
                'name' => 'Задается пользователем',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Задается на законодательном уровне',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Задается пользователем или экспертно',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Задается пользователем или определяется расчетно',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Задается экспертно',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('calculator_parameter_types');
    }
};
