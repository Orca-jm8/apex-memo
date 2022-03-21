<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemoIdUserIdToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('memo_id')->change();
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('memo_id')->references('id')->on('memos')->OnDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('memo_id')->change();
            $table->integer('user_id')->change();
            $table->dropForeign('comments_memo_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
        });
    }
}
