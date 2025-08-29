<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->string('bill_image')->nullable(true);
            $table->integer('installment_number')->nullable(false);
            $table->dateTime('date_and_time')->nullable(false);
            $table->boolean('pay_in_date')->nullable(true);
            $table->dateTime('payed_date')->nullable(true);
            $table->string('amount')->nullable(false);
            $table->string('installment_amount')->nullable(false);
            $table->integer('loan_id')->nullable(false);
            $table->enum('status', ['PAYED', 'UNPAYED'])->default('UNPAYED');
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
        Schema::dropIfExists('installments');
    }
}
