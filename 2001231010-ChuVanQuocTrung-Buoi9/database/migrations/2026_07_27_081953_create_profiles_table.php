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
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        
        // SỬA DÒNG NÀY: Đổi 'user_id' thành 'student_id' và 'users' thành 'students'
        $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
        
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
