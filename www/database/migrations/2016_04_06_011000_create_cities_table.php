<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{

    const MODEL = 'city';
    const TABLE = 'cities';
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
            // Primary Key
            $table->increments(self::PRIMARY_KEY);

            //Foreign Keys
            $table->unsignedInteger(CreateCountriesTable::FOREIGN_KEY);
            $table->foreign(CreateCountriesTable::FOREIGN_KEY)
                ->references(CreateCountriesTable::PRIMARY_KEY)
                ->on(CreateCountriesTable::TABLE)
                ->onDelete('cascade');

            // Data
            $table->text('name');

            // Meta data
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
