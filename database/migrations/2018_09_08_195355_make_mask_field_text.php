<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeMaskFieldText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution_accounts', function($table){
            $table->string('mask')->change();

        });
        Schema::table('bank_accounts', function($table){
            $table->string('mask')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institution_accounts', function($table){
            $table->integer('mask')->change();
        });
        Schema::table('bank_accounts', function($table){
            $table->integer('mask')->change();
        });
    }
}
