<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartProductPivotTable extends Migration
{

    // Laravel Eloquent ORM expects lowercase model names in alphabetical order!
    const TABLE = CreateCartsTable::MODEL.'_'.CreateProductsTable::MODEL;
    const PRIMARY_KEY = [
        CreateCartsTable::FOREIGN_KEY,
        CreateProductsTable::FOREIGN_KEY,
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            // Primary Key (Composite Key)
            foreach (self::PRIMARY_KEY as $column) {
                $table->unsignedInteger($column);
            }
            $table->primary(self::PRIMARY_KEY);

            // Foreign Keys
            $table->foreign(CreateProductsTable::FOREIGN_KEY)
                ->references(CreateProductsTable::PRIMARY_KEY)
                ->on(CreateProductsTable::TABLE)
                ->onDelete('cascade');

            //ERROR door onderstaande FK
            $table->foreign(CreateCartsTable::FOREIGN_KEY)
                ->references(CreateCartsTable::PRIMARY_KEY)
                ->on(CreateCartsTable::TABLE)
                ->onDelete('cascade');

            $table->integer('quantity');
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
