<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table) {
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function($table) {
            $table->dropColumn('user_id');
        }); //For running back the migration
    }
}
/*
php artisan make:migration add_user_id_to_posts //izveido jaunu migrāciju,
kura pievienos tabulai posts lauku user_id, bet tas vel jāieraksta migrācijas funkcijā up

        Schema::table('posts', function($table) {
            $table->integer('user_id');
        });
*/