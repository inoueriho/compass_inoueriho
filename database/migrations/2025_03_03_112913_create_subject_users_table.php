<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_users', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->timestamps();
            // $table->unsignedBigInteger('users_id');
            // $table->unsignedBigInteger('subjects_id');
            // $table->primary(['users_id', 'subjects_id']);
            // $table->foreign('users_id')->references('id')->on('users');
            // $table->foreign('subjects_id')->references('id')->on('subjects');

            // $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            // $table->timestamp();

            $table->id();
            $table->foreignIdFor(Subject::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_users');
    }
}
