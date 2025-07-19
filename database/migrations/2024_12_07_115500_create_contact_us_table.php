<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('business_name'); // Business Name
            $table->string('contact_number', 15); // Contact Number
            $table->string('email')->unique(); // Email
            $table->integer('bank_statements_count')->default(0); // Count of bank statements
            $table->text('message')->nullable(); // Message
            $table->timestamps(); // Created and Updated timestamps (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
