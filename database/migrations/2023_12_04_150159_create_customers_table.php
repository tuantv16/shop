<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('account', 255);
            $table->string('customer_name', 255)->nullable();
            $table->tinyInteger('type')->nullable()->comment('99: Visiting guests, "": Registered guest');;
            $table->string('password');
            $table->string('phone', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('country', 50)->nullable();
            $table->string('city', 255)->nullable(); // thành phố
            $table->string('district', 255)->nullable(); // quận huyện
            $table->string('ward', 255)->nullable(); // phường xã
            $table->string('address1', 255)->nullable();
            $table->string('address2', 255)->nullable();
            $table->string('address3', 255)->nullable();
            $table->text('memo')->nullable();
            $table->integer('disp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
