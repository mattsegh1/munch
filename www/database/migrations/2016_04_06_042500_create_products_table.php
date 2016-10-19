<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{

    const MODEL = 'product';
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
            $table->unsignedInteger(CreateManufacturersTable::FOREIGN_KEY);
            $table->foreign(CreateManufacturersTable::FOREIGN_KEY)
                ->references(CreateManufacturersTable::PRIMARY_KEY)
                ->on(CreateManufacturersTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateCategoriesTable::FOREIGN_KEY);
            $table->foreign(CreateCategoriesTable::FOREIGN_KEY)
                ->references(CreateCategoriesTable::PRIMARY_KEY)
                ->on(CreateCategoriesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateTaxesTable::FOREIGN_KEY);
            $table->foreign(CreateTaxesTable::FOREIGN_KEY)
                ->references(CreateTaxesTable::PRIMARY_KEY)
                ->on(CreateTaxesTable::TABLE)
                ->onDelete('cascade');
            $table->unsignedInteger(CreateDiscountsTable::FOREIGN_KEY)->nullable();
            $table->foreign(CreateDiscountsTable::FOREIGN_KEY)
                ->references(CreateDiscountsTable::PRIMARY_KEY)
                ->on(CreateDiscountsTable::TABLE)
                ->onDelete('cascade');

            // Data
            $table->string('name')->unique();
            $table->text('description');
            $table->decimal('price');
            $table->integer('quantity');
            $table->integer('calories')->nullable();
            $table->string('preview_url')->nullable();

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
