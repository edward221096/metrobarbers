<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->string('description');
            $table->decimal('cost', 7,2);
            $table->mediumText('image')->nullable();
            $table->timestamps();
        });

        //insert services item
        DB::table('services')->insert([
            ['id' => 1, 'service_name' => 'Haircut #1', 'description' => 'Spiky', 'cost' => 200.00, 'image'=>'1583895674.PNG'],
            ['id' => 2, 'service_name' => 'Haircut #2', 'description' => 'Spiky #2', 'cost' => 300.00, 'image'=>'1583896653.PNG'],
            ['id' => 3, 'service_name' => 'Haircut #3', 'description' => 'Johny Bravo Like Hair', 'cost' => 230.00, 'image'=>'1583896689.PNG'],
            ['id' => 4, 'service_name' => 'Haircut #4', 'description' => 'Kulot', 'cost' => 210.00, 'image'=>'1583896723.PNG'],
            ['id' => 5, 'service_name' => 'Haircut #5', 'description' => 'Mohawk', 'cost' => 400.00, 'image'=>'1583896762.PNG'],
            ['id' => 6, 'service_name' => 'Haircut #6', 'description' => 'Rizals Hair', 'cost' => 150.00, 'image'=>'1583896795.PNG'],
            ['id' => 7, 'service_name' => 'Haircut #7', 'description' => 'Kimpy', 'cost' => 100.00, 'image'=>'1583896873.PNG'],
            ['id' => 8, 'service_name' => 'Haircut #8', 'description' => 'Wavy', 'cost' => 500.00, 'image'=>'1583896903.PNG'],
        ]);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
