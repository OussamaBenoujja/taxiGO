<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('license_number');
            $table->date('license_expiry_date');
            $table->string('vehicle_model');
            $table->string('vehicle_registration');
            $table->integer('vehicle_capacity');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->decimal('rating', 3, 2)->nullable();
            $table->timestamps();
        });

      
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region')->nullable();
            $table->string('country')->default('Morocco');
            $table->timestamps();
        });


        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_city_id')->constrained('cities');
            $table->foreignId('destination_city_id')->constrained('cities');
            $table->decimal('approximate_distance', 8, 2); // in kilometers
            $table->integer('approximate_duration'); // in minutes
            $table->decimal('base_fare', 8, 2);
            $table->timestamps();
        });

        Schema::create('driver_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('origin_city_id')->constrained('cities');
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });


        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passenger_id')->constrained('users');
            $table->foreignId('driver_id')->nullable()->constrained('drivers');
            $table->foreignId('origin_city_id')->constrained('cities');
            $table->foreignId('destination_city_id')->constrained('cities');
            $table->string('specific_pickup_location');
            $table->string('specific_dropoff_location');
            $table->date('scheduled_date');
            $table->time('scheduled_pickup_time');
            $table->time('actual_pickup_time')->nullable();
            $table->time('actual_dropoff_time')->nullable();
            $table->integer('passenger_count')->default(1);
            $table->enum('status', [
                'pending', 
                'accepted', 
                'rejected', 
                'cancelled', 
                'completed'
            ])->default('pending');
            $table->string('cancellation_reason')->nullable();
            $table->decimal('fare_amount', 8, 2);
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('trip_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->enum('type', [
                'reservation', 
                'acceptance', 
                'rejection', 
                'cancellation', 
                'reminder'
            ]);
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            $table->foreignId('reviewer_id')->constrained('users');
            $table->foreignId('reviewee_id')->constrained('users');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('trips');
        Schema::dropIfExists('driver_availabilities');
        Schema::dropIfExists('routes');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('drivers');
    }
};