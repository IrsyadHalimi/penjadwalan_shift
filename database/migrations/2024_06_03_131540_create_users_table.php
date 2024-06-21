<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('company_id', 20)->nullable();
            $table->string('department_id', 20)->nullable();
            $table->string('operator_type_id', 20)->nullable();
            $table->string('full_name', 50);
            $table->string('employee_id', 20);
            $table->string('phone_number', 20);
            $table->string('email', 50);
            $table->string('password', 255);
            $table->string('role', 20);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('operator_type_id')->references('id')->on('operator_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
