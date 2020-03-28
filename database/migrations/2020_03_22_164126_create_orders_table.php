<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches');

            $table->string('guest_id')->nullable();

            $table->decimal('sub_total', 20, 2);
            $table->decimal('delivery_fee', 20, 2);
            $table->decimal('grand_total', 20, 2);

            $table->string('payment_method');
            $table->string('payment_status');

            $table->string('payment_reference_number');

            $table->string('fullname');
            $table->string('addressline1');
            $table->string('addressline2')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();

            $table->string('city');
            $table->string('area');

            $table->string('notes')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
