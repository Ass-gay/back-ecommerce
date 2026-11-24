<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // On ajoute le champ 'role' juste après le mot de passe
            $table->string('role')->default('admin')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Permet d'annuler si besoin
            $table->dropColumn('role');
        });
    }
};
