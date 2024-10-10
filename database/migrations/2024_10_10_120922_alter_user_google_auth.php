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
        Schema::table('users', function(Blueprint $table) {
            $table->string('password')->nullable(true)->change();

            $table->string('google_id')->nullable(true);
            $table->string('google_token')->nullable(true);
            $table->string('google_rerfesh_token')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('password')->nullable(false)->change();

            $table->removeColumn('google_id');
            $table->removeColumn('google_token');
            $table->removeColumn('google_refresh_token');
        });
    }
};
