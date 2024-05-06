<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Question;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer_text');
            $table->string('right');

            $table->string('help_type');
            $table->string('help')->nullable();
            $table->text('help_file')->nullable();

            $table->string('explain_type');
            $table->string('explain')->nullable();
            $table->text('explain_file')->nullable();
            $table->foreignIdFor(Question::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
