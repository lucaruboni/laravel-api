<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
             // prima aggiungo la colonna 
             $table->unsignedBigInteger('type_id')->nullable()->after('id');

              // aggiungo la foreign key che collega le tabelle tra di loro
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
                // droppo la foreign key
                $table->dropForeign('projects_type_id_foreign');
                // droppo la colonna
                $table->dropColumn('type_id');
        });
    }
};
