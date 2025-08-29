<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('user_roles', function (Blueprint $table) {
    $table->id();
    $table->string('role_name')->unique(); // Enforced uniqueness
    $table->text('description')->nullable();

    // Permission fields (store as integers: 0 = none, 1 = view, etc.)
    $table->unsignedTinyInteger('dashboard')->default(0);
    $table->unsignedTinyInteger('branch_creation')->default(0);
    $table->unsignedTinyInteger('user_accounts_creation')->default(0);
    $table->unsignedTinyInteger('user_role_creation')->default(0);
    $table->unsignedTinyInteger('centers')->default(0);
    $table->unsignedTinyInteger('members')->default(0);
    $table->unsignedTinyInteger('income')->default(0);
    $table->unsignedTinyInteger('payments')->default(0);
    $table->unsignedTinyInteger('reports')->default(0);
    $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
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
        Schema::dropIfExists('user_roles');
    }
}
