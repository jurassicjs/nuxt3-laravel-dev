<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relationship_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_code');
            $table->unsignedBigInteger('relationship_id')->nullable();
            $table->unsignedBigInteger('specifier_id');
            $table->timestamps();
            $table->foreign('specifier_id')->references('id')->on('users');
            $table->foreign('relationship_id')->references('id')->on('relationships');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relationship_statuses');
    }
};
