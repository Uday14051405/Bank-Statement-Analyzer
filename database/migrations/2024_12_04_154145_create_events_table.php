<?php
// database/migrations/YYYY_MM_DD_create_events_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // Event type (OTP verified, document uploaded, etc.)
            $table->string('location')->nullable(); // Location (e.g., city, country)
            $table->string('ip_address')->nullable(); // IP address of the user
            $table->timestamp('event_time')->useCurrent(); // Date and time of the event
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Related user, if applicable
            $table->string('device_type')->nullable(); // Device type (e.g., mobile, desktop)
            $table->string('browser_details')->nullable(); // Browser details (e.g., Chrome, Firefox)
            $table->string('interface')->nullable(); // Interface (e.g., web, mobile app)
            $table->text('additional_data')->nullable(); // Additional data like OTP, file names, etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
