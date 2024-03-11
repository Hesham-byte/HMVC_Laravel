<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('verify_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('reset_password_token')->nullable();
            $table->dateTime('reset_password_at')->nullable();
            $table->string('status')->default('active');
            $table->string('mobile_number')->nullable();
            $table->bigInteger('role_id')->nullable();
            $table->enum('type', ['admin', 'customer', 'famous', 'merchant'])->default('customer');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
        });

        User::create([
            // 'id' => 1, 
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make('12345678'),
            'type' => 'admin',
            'role_id' => 1
        ]);
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
