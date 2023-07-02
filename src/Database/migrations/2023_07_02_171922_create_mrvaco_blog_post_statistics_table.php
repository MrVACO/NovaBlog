<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mrvaco_blog_post_statistics', function(Blueprint $table)
        {
            $table->integer('post_id')->unsigned()->index()->primary();
            $table->integer('clicks')->unsigned()->default(0); // кол-во кликов
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('mrvaco_blog_post_statistics');
    }
};
