<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactContactList extends Migration
{


    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_list_id');
            $table->foreign('contact_list_id')->references('id')->on('contact_lists');
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['contact_list_id']);
            $table->dropColumn(['contact_list_id']);
        });

    }
}
