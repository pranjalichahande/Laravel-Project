<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('document_name');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('documents');
    }
};
