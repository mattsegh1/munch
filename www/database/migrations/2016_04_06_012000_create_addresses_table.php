<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    const MODEL = 'address';
    const TABLE = self::MODEL.'es';
    const PRIMARY_KEY = 'id';
    const FOREIGN_KEY = self::MODEL.'_'.self::PRIMARY_KEY;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            //Data
            $table->increments(self::PRIMARY_KEY);
            $table->string('street');

            //Foreign Keys
            $table->unsignedInteger(CreateCitiesTable::FOREIGN_KEY);
            $table->foreign(CreateCitiesTable::FOREIGN_KEY)
                ->references(CreateCitiesTable::PRIMARY_KEY)
                ->on(CreateCitiesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateCustomersTable::FOREIGN_KEY);
            $table->foreign(CreateCustomersTable::FOREIGN_KEY)
                ->references(CreateCustomersTable::PRIMARY_KEY)
                ->on(CreateCustomersTable::TABLE)
                ->onDelete('cascade');

            //Meta Data
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(self::TABLE);
    }
}
