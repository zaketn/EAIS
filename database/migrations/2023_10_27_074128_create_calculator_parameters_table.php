<?php

use App\Models\CalculatorParameters;
use App\Models\CalculatorParameterTypes;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('calculator_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('value');

            $table->foreignIdFor(CalculatorParameterTypes::class)
                ->constrained();

            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });

        CalculatorParameters::query()->insert([
            [
                'name' => 'Прожиточный минимум',
                'slug' => 'living_wage',
                'value' => 14375,
                'calculator_parameter_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Доля предметов первой необходимости в структуре потребительских расходов домашнего хозяйства',
                'slug' => 'essential_items_share',
                'value' => 0.6582,
                'calculator_parameter_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Доля предметов длительного пользования в структуре потребительских расходов домашнего хозяйства',
                'slug' => 'durable_goods_share',
                'value' => 0.2238,
                'calculator_parameter_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Доля предметов роскоши в структуре потребительских расходов домашнего хозяйства',
                'slug' => 'luxury_goods_share',
                'value' => 0.118,
                'calculator_parameter_types_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Нижняя граница среднедушевого денежного дохода домашнего хозяйства в месяц, позволяющего приобретать предметы роскоши',
                'slug' => 'luxury_lower_limit',
                'value' => 55525.61,
                'calculator_parameter_types_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ставка налога на доходы физических лиц',
                'slug' => 'income_tax_rate',
                'value' => 0.13,
                'calculator_parameter_types_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('calculator_parameters');
    }
};
