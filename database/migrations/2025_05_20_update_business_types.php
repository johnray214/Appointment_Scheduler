<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update existing business types
        DB::table('business_profiles')
            ->where('business_type', 'barbershop')
            ->update(['business_type' => 'Barber Shop']);

        DB::table('business_profiles')
            ->where('business_type', 'salon')
            ->update(['business_type' => 'Salon']);
    }

    public function down(): void
    {
        // Revert the changes if needed
        DB::table('business_profiles')
            ->where('business_type', 'Barber Shop')
            ->update(['business_type' => 'barbershop']);

        DB::table('business_profiles')
            ->where('business_type', 'Salon')
            ->update(['business_type' => 'salon']);
    }
};
