<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('partenaire_id')->constrained();
            $table->text('description');
            $table->integer('note');
            $table->date('date');
            $table->string('type', 10);
            $table->string('visibilite', 10);
        });
    }

    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
