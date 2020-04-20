<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCovidCasesTable extends Migration
{
    public function up()
    {
        Schema::table('covid_cases', function (Blueprint $table) {
            $table->unsignedInteger('source_id')->nullable();
            $table->foreign('source_id', 'source_fk_1342336')->references('id')->on('covid_cases');
        });

    }
}
