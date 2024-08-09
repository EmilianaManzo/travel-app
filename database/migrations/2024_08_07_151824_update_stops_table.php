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
        Schema::table('stops', function (Blueprint $table) {
            // creo la colonna della fk
            $table->unsignedBigInteger('travel_id')->nullable()->after('id');

            // assegno la fk alla colonna creata
            $table->foreign('travel_id')
                    ->references('id')
                    ->on('travels')
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stops', function (Blueprint $table) {
            //
            $table->dropForeign(['travel_id']);
            $table->dropColumn('travel_id');
        });
    }
};
