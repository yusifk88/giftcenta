<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_card', function (Blueprint $table) {
            $table->id();
            $table->string('billing_name');
            $table->double('amount',32,2);
            $table->string('currency');
            $table->string('sendername');
            $table->string('senderemail');
            $table->text('message')->nullable();
            $table->string('recipientname');
            $table->string('recipientemail');
            $table->string('number')->nullable();
            $table->string('masked_number')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('cvv')->nullable();
            $table->boolean('created')->default(false);

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
        Schema::dropIfExists('virtual_card');
    }
}
