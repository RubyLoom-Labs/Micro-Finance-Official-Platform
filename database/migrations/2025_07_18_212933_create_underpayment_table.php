<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnderpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('underpayments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('amount')->nullable(false);
            $table->date('payed_date')->nullable(false);
            $table->string('bill_image')->nullable(true);
            $table->integer('installment_id')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('underpayment');
    }
}
