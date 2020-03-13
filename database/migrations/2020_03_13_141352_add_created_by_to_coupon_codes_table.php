<?php

use App\CouponCode;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedByToCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CouponCode::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by','fk_code_creator')->on(User::TABLE_NAME)->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(CouponCode::TABLE_NAME, function (Blueprint $table) {
            $table->dropForeign('fk_code_creator');
            $table->dropColumn('created_by');
        });
    }
}
