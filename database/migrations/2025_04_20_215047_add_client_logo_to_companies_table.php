<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings_company', function (Blueprint $table) {
            $table->string('client_logo')->nullable();
            $table->boolean('use_client_logo')->default(false);
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
            $table->dropColumn('client_logo');
            $table->dropColumn('use_client_logo');
        });
    }
};
