<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable(false);
            $table->string('mobile_number_1')->nullable(false);
            $table->string('mobile_number_2')->nullable(false);
            $table->string('image_1')->nullable(false);
            $table->string('image_2')->nullable(true);
            $table->enum('gender', ['MALE', 'FEMALE'])->nullable(false);
            $table->string('address')->nullable(false);
            $table->string('nic_number')->unique();
            $table->integer('group_id')->nullable(false);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'TERMINATED'])->default('ACTIVE');
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
        Schema::dropIfExists('members');
    }
}
