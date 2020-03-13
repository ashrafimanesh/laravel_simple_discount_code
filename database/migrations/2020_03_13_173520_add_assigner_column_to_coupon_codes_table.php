<?php

use App\CouponCode;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssignerColumnToCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(CouponCode::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_by')->nullable()->after('assigned_to');
            $table->foreign('assigned_by','fk_code_assigned_by')->on(User::TABLE_NAME)->references('id');
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
            $table->dropForeign('fk_code_assigned_by');
            $table->dropColumn('assigned_by');
        });
    }
}
