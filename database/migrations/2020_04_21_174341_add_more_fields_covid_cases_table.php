<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsCovidCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('covid_cases', function (Blueprint $table) {
            $table->boolean('critical')->default(false)->index();
            $table->string('cluster_name')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('covid_cases', function (Blueprint $table) {
            $table->dropColumn(['critical', 'cluster_name']);
        });
    }
}
