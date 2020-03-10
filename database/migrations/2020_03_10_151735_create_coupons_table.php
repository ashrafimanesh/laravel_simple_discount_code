<?php

use App\Brand;
use App\Coupon;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Coupon::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('brand_id');
            $table->double('amount');
            $table->enum('type', Coupon::types())->default(Coupon::TYPE_NORMAL);
            $table->string('link')->nullable();
            $table->enum('status',Coupon::statuses())->default(Coupon::STATUS_ACTIVE);
            $table->timestamp('published_at')->index();
            $table->timestamp('expired_at')->nullable()->index();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['brand_id','name']);
            $table->foreign('brand_id')->on(Brand::TABLE_NAME)->references('id');
            $table->foreign('created_by')->on(User::TABLE_NAME)->references('id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Coupon::TABLE_NAME);
    }
}
