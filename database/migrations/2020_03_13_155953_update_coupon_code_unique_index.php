<?php

use App\CouponCode;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCouponCodeUniqueIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CouponCode::TABLE_NAME, function (Blueprint $table) {
            $table->dropUnique('coupon_codes_code_unique');
            $table->unique(['coupon_id','code'],'coupon_id_code_unique');
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
            $table->unique(['code'],'coupon_codes_code_unique');
            $table->dropUnique('coupon_id_code_unique');
        });
    }
}
