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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->after('name');
            $table->string('address')->nullable()->after('profile_image');
            $table->string('city')->nullable()->after('address');
            $table->string('country')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('profile_image');
            $table->dropColumn('cover_image');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('about_me');
        });
    }
};
