<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPartenairesTable extends Migration
{
    public function up()
    {
        Schema::table('partenaires', function (Blueprint $table) {
            $table->string('prenom')->nullable()->after('nom');
            $table->string('num_telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('profil_picture')->nullable();
            $table->text('description')->nullable();
            $table->string('cin')->nullable();
        });
    }

    public function down()
    {
        Schema::table('partenaires', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'num_telephone', 'adresse', 'profil_picture', 'description', 'cin']);
        });
    }
}
