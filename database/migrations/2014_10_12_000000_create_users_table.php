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
            $table->string('num_document', 50)->unique()->nullable();
            $table->string('first_names')->nullable();
            $table->string('last_name1')->nullable();
            $table->string('last_name2')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('edad')->nullable(); //default('');
            /* dividir procedencia en3: dep, prov, dis */
            $table->string('procedencia_dep', 2)->nullable();
            $table->string('procedencia_prov', 4)->nullable();
            $table->string('procedencia_dis', 6)->nullable();
            $table->string('direccion')->nullable();
            $table->enum('estado_civil', array('S (Soltero)','C (Casado)', 'Co (Conviviente)', 'D (Divorciado)', 'V (Viudo)'))->default('S (Soltero)');
            $table->string('ocupacion')->nullable();
            $table->string('celular')->nullable();
            $table->string('refiere')->nullable();
            $table->string('medico_tratante')->nullable();
            $table->text('otros')->nullable();
            $table->unsignedBigInteger('specific_role_id')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_role_id')->references('id')->on('user_roles')->cascadeOnDelete();
        });

        $this->postCreate(array([
            'user_role_id' => '1',
            'num_document' => 'dfernandez',
            'first_names' => 'Diego Alejandro',
            'last_name1' => 'Fernandez',
            'last_name2' => 'Rivera',
            'email' => 'diego.ale.fernandez.rivera@gmail.com',
            'password' => bcrypt('dfernandez')
        ]));

        $this->postCreate(array([
            'user_role_id' => '1',
            'num_document' => 'macuna',
            'first_names' => 'María Isabel',
            'last_name1' => 'Acuña',
            'last_name2' => 'Perez',
            'password' => bcrypt('macuna')
        ]));

        $this->postCreate(array([
            'user_role_id' => '1',
            'num_document' => 'dmechan',
            'first_names' => 'Daysy',
            'last_name1' => 'Mechan',
            'last_name2' => '',
            'password' => bcrypt('dmechan')
        ]));

        // $this->postCreate(array([
        //     'user_role_id' => '2',
        //     'num_document' => 'btito',
        //     'first_names' => 'BRENDA FATIMA',
        //     'last_names' => 'TITO LEIVA',
        //     'email' => '',
        //     'password' => bcrypt('70117381')
        // ]));
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
