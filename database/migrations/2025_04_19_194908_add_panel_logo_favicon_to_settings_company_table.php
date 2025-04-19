<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPanelLogoFaviconToSettingsCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings_company', function (Blueprint $table) {
            if (!Schema::hasColumn('settings_company', 'panel_logo')) {
                $table->string('panel_logo')->nullable();
            }
            if (!Schema::hasColumn('settings_company', 'favicon')) {
                $table->string('favicon')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings_company', function (Blueprint $table) {
            if (Schema::hasColumn('settings_company', 'panel_logo')) {
                $table->dropColumn('panel_logo');
            }
            if (Schema::hasColumn('settings_company', 'favicon')) {
                $table->dropColumn('favicon');
            }
        });
    }
}
