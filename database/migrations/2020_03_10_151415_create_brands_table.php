<?php

use App\Brand;
use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Brand::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->unsignedBigInteger('category_id');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->on(Category::TABLE_NAME)->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Brand::TABLE_NAME);
    }
}
