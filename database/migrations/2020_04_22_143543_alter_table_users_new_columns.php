<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsersNewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_in_soc', 20)
                ->default('')
                ->comment('ID в соцсети');
            $table->enum('type_auth', ['site', 'vk', 'fb', 'gh'])
                ->default('site')
                ->comment('Тип авторизации');
            $table->string('avatar', 150)
                ->default('')
                ->comment('Ссылка на аватарку');
            $table->index('id_in_soc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id_in_soc']);
            $table->dropColumn(['type_auth']);
            $table->dropColumn(['avatar']);
            $table->dropIndex('id_in_soc');
        });
    }
}
