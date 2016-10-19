<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{

    const MODEL = 'customer';
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

            // Primary Key
            $table->increments(self::PRIMARY_KEY);

            // Data
            $table->string('first_name');
            $table->string('last_name');
            //$table->text('email'); //Moved to user instead

            // Foreign Keys
            $table->unsignedInteger(CreateUsersTable::FOREIGN_KEY)->unique();
            $table->foreign(CreateUsersTable::FOREIGN_KEY)
                ->references(CreateUsersTable::PRIMARY_KEY)->on(CreateUsersTable::TABLE)
                ->onDelete('cascade');

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
