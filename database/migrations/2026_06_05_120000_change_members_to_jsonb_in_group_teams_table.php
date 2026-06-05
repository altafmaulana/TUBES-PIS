<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('group_teams', function (Blueprint $table) {
            $table->jsonb('members')->change();
        });
    }

    public function down(): void
    {
        Schema::table('group_teams', function (Blueprint $table) {
            $table->json('members')->change();
        });
    }
};
