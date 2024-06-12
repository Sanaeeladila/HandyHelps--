<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartenairesTable extends Migration
{
    public function up()
    {
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50);
            $table->string('metier', 255);
            $table->string('ville', 50);
            $table->integer('annees_exp');
            $table->boolean('disponibilite');
            $table->float('prix_intervention');
            $table->integer('moy_evaluation');
        });
    }

    public function down()
    {
        Schema::dropIfExists('partenaires');
    }
}
