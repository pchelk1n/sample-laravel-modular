<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tasks', static function (Blueprint $table): void {
            $table->boolean('is_completed')->default(false)->change();
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tasks', static function (Blueprint $table): void {
            $table->boolean('is_completed')->change();
            $table->dropColumn('description');
        });
    }
};
