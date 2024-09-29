<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('biography_links', function (Blueprint $table) {
            $table->uuid("id")->primary()->unique();
            $table->uuid('biography_id');
            $table->string('icon');
            $table->string('name');
            $table->string('href');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biography_links');
    }
};
