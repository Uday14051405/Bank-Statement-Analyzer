<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsaDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsa_documents', function (Blueprint $table) {
            $table->id('document_id'); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key
            $table->string('mobile_number', 15); // Mobile Number
            $table->string('bank_name'); // Bank Name
            $table->string('file_name'); // File Name
            $table->string('unique_file_name')->unique(); // Unique File Name
            $table->string('file_pwd')->nullable(); // File Password
            $table->timestamp('document_created_at')->nullable(); // Document Created DateTime
            $table->timestamp('document_updated_at')->nullable(); // Document Updated DateTime
            $table->string('document_url'); // Document URL
            $table->unsignedBigInteger('uploaded_user')->nullable(); // Uploaded User, nullable for onDelete('set null')
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active'); // Status
            $table->unsignedBigInteger('updated_user')->nullable(); // Updated User
            $table->timestamps(); // Created and Updated timestamps
    
            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('uploaded_user')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_user')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bsa_documents');
    }
}
