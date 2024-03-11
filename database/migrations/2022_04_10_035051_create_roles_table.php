<?php

use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name_ar', 50);
            $table->string('name_en', 50);
            $table->boolean('full_access')->default(false);
            $table->boolean('can_download')->default(false);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });

        Role::create([
            'id' => 1,
            'name_ar' => 'سوبر ادمن',
            'name_en' => 'Super Admin',
            'full_access' => 1,
            'can_download' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
