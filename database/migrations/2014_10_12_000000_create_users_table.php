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
            'last_names' => 'Fernandez',
            'email' => 'diego.ale.fernandez.rivera@gmail.com',
            'password' => bcrypt('48238255')
        ]));

        $this->postCreate(array([
            'user_role_id' => '2',
            'num_document' => '77777777',
            'first_names' => 'Doctor 1',
            'last_names' => 'Lozano Antonio',
            'email' => 'doctor1@gmail.com',
            'password' => bcrypt('jrlozanoa@gmail.com')
        ]));

        $this->postCreate(array([
            'user_role_id' => '4',
            'num_document' => 'reumainnova@gmail.com',
            'first_names' => 'Asistente',
            'last_names' => 'Administrativo',
            'email' => 'reumainnova@gmail.com',
            'password' => bcrypt('reumainnova@gmail.com')
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
