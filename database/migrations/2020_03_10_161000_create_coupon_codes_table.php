<?php

use App\Coupon;
use App\CouponCode;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CouponCode::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('assigned_to')->nullable()->index();

            $table->timestamp('assigned_at')->nullable();
            $table->timestamps();

            $table->foreign('coupon_id')->on(Coupon::TABLE_NAME)->references('id');
            $table->foreign('assigned_to')->on(User::TABLE_NAME)->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CouponCode::TABLE_NAME);
    }
}
