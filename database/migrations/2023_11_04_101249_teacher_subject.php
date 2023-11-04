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
      Schema::create('teacher_subject', function (Blueprint $table) {
         $table->id();
         $table->bigInteger('teacher_id');
         $table->bigInteger('subject_id');

         // Ha a teacher táblában kitörlünk egy tanárt, akkor itt az összes tanárhoz tartozó adatot is kitörli!
         // $table->foreign('teacher_id')->references('id')->on('teacher')->onDelete('cascade');
         // $table->foreign('subject_id')->references('id')->on('subject')->onDelete('cascade');
      });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
      Schema::dropIfExists('teacher_subject');
   }
};
