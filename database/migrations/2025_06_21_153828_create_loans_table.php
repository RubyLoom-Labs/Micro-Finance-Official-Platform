<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('guarantor')->nullable(false);
            $table->string('document_charges')->nullable(true);
            $table->string('loan_amount')->nullable(false);
            $table->string('image_1')->nullable(false);
            $table->integer('installment_price')->nullable(false);
            $table->date('issue_date')->nullable(false);
            $table->date('completed_date')->nullable(true);
            $table->string('interest_rate')->nullable(false);
            $table->string('terms')->nullable(false);
            $table->string('interest')->nullable(false);
            $table->enum('status', ["UNCOMPLETED", "COMPLETED"])->default("UNCOMPLETED");
            $table->integer('member_id')->nullable(false);
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
        Schema::dropIfExists('loans');
    }
}
