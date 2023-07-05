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
            $table->string('num_document', 50)->unique();
            $table->string('first_names')->nullable();
            $table->string('last_name1')->nullable();
            $table->string('last_name2')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->default(18);
            /* dividir procedencia en3: dep, prov, dis */
            $table->string('procedencia_dep', 2)->nullable();
            $table->string('procedencia_prov', 4)->nullable();
            $table->string('procedencia_dis', 6)->nullable();
            $table->string('direccion')->nullable();
            $table->enum('estado_civil', array('S (Soltero)','C (Casado)', 'Co (Conviviente)', 'D (Divorciado)', 'V (Viudo)'))->default('S (Soltero)');
            $table->string('ocupacion')->nullable();
            $table->text('otros')->nullable();
            $table->unsignedBigInteger('specific_role_id')->nullable();
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
            'last_name1' => 'Fernandez',
            'last_name2' => 'Rivera',
            'email' => 'diego.ale.fernandez.rivera@gmail.com',
            'password' => bcrypt('48238255')
        ]));

        $this->postCreate(array([
            'user_role_id' => '2',
            'num_document' => 'laboratorio',
            'first_names' => 'Laboratorio',
            'last_names' => '',
            'email' => 'laboratorio@gmail.com',
            'password' => bcrypt('laboratorio')
        ]));

        $this->postCreate(array([
            'user_role_id' => '2',
            'num_document' => 'ecografia',
            'first_names' => 'Ecografía',
            'last_names' => '',
            'email' => 'ecografia@gmail.com',
            'password' => bcrypt('ecografia')
        ]));

        $this->postCreate(array([
            'user_role_id' => '2',
            'num_document' => 'admision',
            'first_names' => 'Admisión',
            'last_names' => '',
            'email' => 'admision@gmail.com',
            'password' => bcrypt('admision')
        ]));

        $this->postCreate(array([
            'user_role_id' => '2',
            'num_document' => 'rayosx',
            'first_names' => 'Rayos X',
            'last_names' => '',
            'email' => 'rayosx@gmail.com',
            'password' => bcrypt('rayosx')
        ]));

        $this->postCreate(array([
            'user_role_id' => '2',
            'num_document' => 'tomografia',
            'first_names' => 'Tomografía',
            'last_names' => '',
            'email' => 'tomografia@gmail.com',
            'password' => bcrypt('tomografia')
        ]));

        $this->postCreate(array([
            'user_role_id' => '2',
            'num_document' => 'staffmedico',
            'first_names' => 'Staff Médico',
            'last_names' => '',
            'email' => 'staffmedico@gmail.com',
            'password' => bcrypt('staffmedico')
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
