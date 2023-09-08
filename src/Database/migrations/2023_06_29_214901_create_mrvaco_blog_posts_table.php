<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MrVaco\NovaStatusesManager\Classes\StatusClass;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mrvaco_blog_posts', function(Blueprint $table)
        {
            $table->id();
            
            $table->integer('category_id')->default(1);
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('keywords')->nullable();
            $table->string('tags')->nullable();
            $table->text('introductory');
            $table->longText('content');
            $table->integer('status')->default(StatusClass::DRAFT()->id);
            $table->string('image')->nullable();
            $table->integer('creator_id')->unsigned();
            $table->integer('updator_id')->unsigned();
            $table->timestamp('published_at')->nullable();
            $table->integer('gallery_id')->nullable()->unsigned();
            $table->boolean('recommended')->default(false);
            
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('mrvaco_blog_posts');
    }
};
