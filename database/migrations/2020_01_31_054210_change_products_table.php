<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('products', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->dropColumn('other_images');
            $table->longText('warranty')->nullable()->change();
            $table->string('currency')->nullable();
            $table->string('small_thumbnail');
            $table->string('big_thumbnail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
