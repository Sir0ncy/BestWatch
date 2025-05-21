use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMovieTable extends Migration
{
    public function up()
    {
        Schema::create('user_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(users)->onDelete('cascade');
            $table->foreignId('movie_id')->constrained(movies)->onDelete('cascade');
            $table->enum('status', ['watchlist', 'favorite'])->default('watchlist');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_movie');
    }
}
