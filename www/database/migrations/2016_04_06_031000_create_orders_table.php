<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    const MODEL = 'order';
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

            // Foreign Keys
            $table->unsignedInteger(CreateCustomersTable::FOREIGN_KEY);
            $table->foreign(CreateCustomersTable::FOREIGN_KEY)
                ->references(CreateCustomersTable::PRIMARY_KEY)
                ->on(CreateCustomersTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateAddressesTable::FOREIGN_KEY);
            $table->foreign(CreateAddressesTable::FOREIGN_KEY)
                ->references(CreateAddressesTable::PRIMARY_KEY)
                ->on(CreateAddressesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateOrderStatusesTable::FOREIGN_KEY);
            $table->foreign(CreateOrderStatusesTable::FOREIGN_KEY)
                ->references(CreateOrderStatusesTable::PRIMARY_KEY)
                ->on(CreateOrderStatusesTable::TABLE)
                ->onDelete('cascade');

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
