<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsaReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsa_reports', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->json('doc_ids'); // JSON payload for document IDs
            $table->json('request_payload'); // Request Payload
            $table->json('response_payload'); // Response Payload
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Status
            $table->string('report_id')->unique(); // REPORT_ID (unique identifier)
            $table->string('report_url'); // Report URL
            $table->timestamps(); // Created and Updated timestamps (created_at, updated_at)
            $table->timestamp('downloaded_at')->nullable(); // Downloaded DateTime
            $table->boolean('is_sms_link_active')->default(true); // Is SMS Link Active
            $table->string('mobile_number', 15); // Mobile Number
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bsa_reports');
    }
}
