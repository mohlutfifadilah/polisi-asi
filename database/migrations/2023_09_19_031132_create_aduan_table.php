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
    Schema::create('aduan', function (Blueprint $table) {
      $table->id();
      $table->integer('id_aduan')->nullable();
      $table->integer('id_user');
      $table->integer('id_subkategori');
      $table->integer('id_status');
      $table->integer('id_role');
      $table->string('aduan');
      $table->text('bukti')->nullable();
      $table->string('response')->nullable();
      $table->integer('is_publish')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('aduan');
  }
};
