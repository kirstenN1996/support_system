<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });*/
	Schema::create('tickets', function (Blueprint $table) {
        	$table->id();
        	$table->string('category'); // Sales, Accounts, IT
        	$table->string('first_name');
        	$table->string('last_name');
        	$table->string('email');
        	$table->text('issue'); // Ticket description
        	$table->string('status')->default('new'); // new, in_progress, resolved
        	$table->decimal('latitude', 10, 7)->nullable();
        	$table->decimal('longitude', 10, 7)->nullable();
        	$table->unsignedBigInteger('user_id')->nullable(); // Agent who logged the ticket
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
        Schema::dropIfExists('tickets');
    }
}
