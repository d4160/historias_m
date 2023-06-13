<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
            $table->unsignedSmallInteger('user_role_id')->default(3);
            $table->string('num_document', 11)->unique();
            $table->string('first_names');
            $table->string('last_names');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('user_role_id')->references('id')->on('user_roles')->cascadeOnDelete();
        });

        $this->postCreate(array([
            'user_role_id' => '1',
            'num_document' => '48238255',
            'first_names' => 'Diego',
            'last_names' => 'Fernandez',
            'email' => 'diego.ale.fernandez.rivera@gmail.com',
            'password' => bcrypt('48238255')
        ]));
    }

    private function postCreate(array $users)  {
        foreach ($users as $user) {
            $model = new User($user);
            $model->save();
        }
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
