<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('polygons', function (Blueprint $table) {
            $table->unsignedInteger('zone_id')->nullable()->after('vertices');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('polygons', function (Blueprint $table) {
            $table->dropForeign('polygons_zone_id_foreign');
        });
    }
};
