<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductHistoriesTable extends Migration
{
    const MODEL = 'product_history';
    const TABLE = 'product_histories';
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
            $table->unsignedInteger('quantity')->nullable();
            $table->decimal('price')->nullable();

            // Foreign Keys
            $table->unsignedInteger(CreateProductsTable::FOREIGN_KEY);
            $table->foreign(CreateProductsTable::FOREIGN_KEY)
                ->references(CreateProductsTable::PRIMARY_KEY)
                ->on(CreateProductsTable::TABLE)
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
