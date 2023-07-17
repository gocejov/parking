<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->unsignedInteger('zone_id')->nullable()->after('user_id');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('set null');
            $table->dropColumn('location');
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->string('location')->nullable()->after('phone_number');
            $table->dropForeign(['zone_id']);
            $table->dropColumn('zone_id');
        });
    }
};
