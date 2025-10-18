<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // ... inside the new migration file
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // We use nullable() because these fields are not required at registration
        $table->string('full_name')->nullable()->after('name');
        $table->string('phone_number')->nullable()->after('full_name');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
