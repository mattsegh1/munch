<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    const MODEL = 'cart';
    const TABLE = self::MODEL.'s';
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

            // Foreign Keys
            $table->unsignedInteger(CreateCartStatusesTable::FOREIGN_KEY);
            $table->foreign(CreateCartStatusesTable::FOREIGN_KEY)
                ->references(CreateCartStatusesTable::PRIMARY_KEY)->on(CreateCartStatusesTable::TABLE)
                ->onDelete('cascade');

            //Meta Data
            $table->timestamps();
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
