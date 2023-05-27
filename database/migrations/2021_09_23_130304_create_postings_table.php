<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('schedule');
            $table->string('amount');
            $table->string('postingtext');
            $table->string('postingaccount_debit');
            $table->string('postingaccount_credit');
            $table->string('vat');
            $table->string('status');
            $table->dateTime('last_posted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postings');
    }
}
