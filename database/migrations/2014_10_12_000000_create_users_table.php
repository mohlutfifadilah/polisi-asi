<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->integer('id_role');
      $table->string('profile_photo_path', 2048)->nullable();
      $table->string('email')->unique()->nullable();
      $table->string('no_wa')->unique()->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->string('name');
      $table->string('address')->nullable();
      $table->string('job_or_position')->nullable();
      $table->integer('age')->nullable();
      $table->integer('is_active')->default(1);
      $table->rememberToken();
      $table->foreignId('current_team_id')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
