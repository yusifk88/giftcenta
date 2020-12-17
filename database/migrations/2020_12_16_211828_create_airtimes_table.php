<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirtimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airtimes', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('country');
            $table->string('network');
            $table->double('amount');
            $table->string('recipient_email');
            $table->string('sender_email')->nullable();
            $table->string('sender_name')->nullable();
            $table->text('message')->nullable();
            $table->boolean('paid')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airtimes');
    }
}
