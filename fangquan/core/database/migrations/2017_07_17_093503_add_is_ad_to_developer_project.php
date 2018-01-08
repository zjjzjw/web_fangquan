<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdToDeveloperProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developer_project', function (Blueprint $table) {
            $table->tinyInteger('is_ad')->default(0)->after('status')->comment('是否是广告 1=是 2=否');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developer_project', function (Blueprint $table) {
            $table->dropColumn('is_ad');
        });
    }
}
