<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('import_failures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('contestant_id')
                ->nullable()
                ->constrained('contestants');
            $table->string('key')->nullable();
            $table->string('value')->nullable();
            $table->string('error');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_failures');
    }
};
