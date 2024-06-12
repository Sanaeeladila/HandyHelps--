<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('partenaire_id')->constrained();
            $table->foreignId('categorie_id')->constrained();
            $table->string('titre', 255);
            $table->text('description');
            $table->date('date_demande');
            $table->date('date_debut');
            $table->string('duree', 255);
            $table->string('statut', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
