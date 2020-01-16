<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('company_name');

            $table->string('contact_name');

            $table->string('contact_number');

            $table->string('contact_mail');

            $table->string('event');

            $table->string('account_manager');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
