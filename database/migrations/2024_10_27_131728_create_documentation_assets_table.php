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
        Schema::create('documentation_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('generated_path');
            $table->unsignedBigInteger('documentation_page_id');
            $table->foreign('documentation_page_id')->references('id')->on('documentation_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentation_assets');
    }
};
