<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidCasesTable extends Migration
{
    public function up()
    {
        Schema::create('covid_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('case_identity')->unique();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->date('date_detected')->nullable();
            $table->date('date_recovered')->nullable();
            $table->string('location_detected')->nullable();
            $table->string('description')->nullable();
            $table->string('status');
            $table->string('deceased_date')->nullable();
            $table->string('infection_source')->nullable();
            $table->string('nationality')->nullable();
            $table->date('symptomatic_date')->nullable();
            $table->boolean('displayed_symptoms')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
