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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            //for father and mother
            $table->string("Email");
            $table->string("Password");

            //father info
            $table->foreignId("Nationalities_id_father")->constrained("nationalities")->onDelete("cascade");
            $table->foreignId("TypeBlood_id_father")->constrained("type_bloods")->onDelete("cascade");
            $table->foreignId("Religion_id_father")->constrained("religions")->onDelete("cascade");
            $table->string("Name_father");
            $table->string("National_id_father");
            $table->string("Passport_id_father");
            $table->string("Phone_father");
            $table->string("Job_father");
            $table->string("Address_father");

            //mother info
            $table->foreignId("Nationalities_id_mother")->constrained("nationalities")->onDelete("cascade");
            $table->foreignId("TypeBlood_id_mother")->constrained("type_bloods")->onDelete("cascade");
            $table->foreignId("Religion_id_mother")->constrained("religions")->onDelete("cascade");
            $table->string("Name_mother");
            $table->string("National_id_mother");
            $table->string("Passport_id_mother");
            $table->string("Phone_mother");
            $table->string("Job_mother");
            $table->string("Address_mother");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_parents');
    }
};
