<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEmployeeUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW vw_employee
            AS
            SELECT
                users.id,
                users.name,
                users.email,
                users.username,
                users.role,
                users.gender,
                users.address,
                users.phonenumber,
                users.password
            FROM
                users
            WHERE
                users.role = 'Barber'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vw_employee');
    }
}
