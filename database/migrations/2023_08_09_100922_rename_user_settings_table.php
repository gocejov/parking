<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('user_settings', 'user_vehicles');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::rename('user_vehicles', 'user_settings');
    }
}

;
