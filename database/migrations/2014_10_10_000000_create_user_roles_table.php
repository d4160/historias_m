<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\UserRole;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('label');
            $table->timestamps();
        });

        $this->postCreate('Super Usuario', 'Administrador', 'Paciente');
    }

    private function postCreate(string ...$roles)  {
        foreach ($roles as $role) {
            $model = new UserRole();
            $model->setAttribute('label', $role);
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
        Schema::dropIfExists('user_roles');
    }
}
