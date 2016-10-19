<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    const MODEL = 'rating';
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
            $table->integer('value');

            //Foreign Keys
            $table->unsignedInteger(CreateCustomersTable::FOREIGN_KEY);
            $table->foreign(CreateCustomersTable::FOREIGN_KEY)
                ->references(CreateCustomersTable::PRIMARY_KEY)
                ->on(CreateCustomersTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateProductsTable::FOREIGN_KEY);
            $table->foreign(CreateProductsTable::FOREIGN_KEY)
                ->references(CreateProductsTable::PRIMARY_KEY)
                ->on(CreateProductsTable::TABLE)
                ->onDelete('cascade');

            $table->timestamps();
        });

        //compound key
        DB::unprepared('ALTER TABLE ratings ADD CONSTRAINT CK_Customer_Rating UNIQUE (customer_id, product_id)');
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
