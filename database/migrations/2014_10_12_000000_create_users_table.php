<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at');
            $table->string('password')->nullable();
            $table->string('occupation')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable();

            $table->unsignedInteger('gender_id')->nullable();

            $table->unsignedInteger('specialty_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('pain_id')->nullable();
            $table->unsignedInteger('role_id')->nullable();
            $table->date('birth_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                array(
                    'username' => 'Admin',
                    'password' => Hash::make('admin') ,
                    'role_id' => 1
                )
            )

        );



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
