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
        Schema::create('core1_ecm', function (Blueprint $table) {
            $table->id('eventID');
            $table->string('eventphoto');
            $table->string('eventname');
            $table->string('eventtype');
            $table->string('eventorganizername');
            $table->string('eventcontactemail');
            $table->integer('eventdays');
            $table->string('eventcontactnumber');
            $table->date('eventdate');
            $table->time('event_time_start');
            $table->time('event_time_end');
            $table->integer('eventexpectedguest');
            $table->string('eventneedroombooking');
            $table->longText('eventequipment');
            $table->longText('eventspecialrequest');
            $table->string('eventstatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core1_ecm');
    }
};
