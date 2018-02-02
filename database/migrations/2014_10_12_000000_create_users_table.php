 <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//1-php artisan migrate:fresh//
//2-php artisan db:seed//
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('user_name')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('info_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('family');
            $table->string('national_code');
            $table->string('phone_number',20)->nullable();
            $table->string('mobile_number',20)->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code');
            $table->boolean('gender')->default(0);
            $table->string('user_email')->unique();
            $table->date('birthday');
            $table->string('imagePath')->default('null');
            // seller id means some one who benefit from your sell and get commission
            $table->integer('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('id')->on('users');
            $table->float('commission',8,2)->default(0);//0<commission<100

            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('warranties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('viewCount')->default('0');
            $table->string('title');
            $table->integer('price');
            $table->float('discount',8,4)->nullable();
            $table->integer('inventory');
            $table->string('warranty')->nullable();
            $table->string('color')->nullable();
            $table->integer('weight')->nullable();
            $table->string('size')->nullable();
            $table->text('description')->nullable();
            $table->longText('long_description')->nullable();
            $table->timestamps();
        });

        Schema::create('color_product', function (Blueprint $table) {
            $table->integer('color_id')->unsigned()->index();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->primary(['color_id', 'product_id']);
        });
        Schema::create('product_warranty', function (Blueprint $table) {
            $table->integer('warranty_id')->unsigned()->index();
            $table->foreign('warranty_id')->references('id')->on('warranties')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->primary(['warranty_id', 'product_id']);
        });
        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->primary(['category_id', 'product_id']);
        });

        Schema::create(config('cart.database.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('identifier');
            $table->string('instance');
            $table->longText('content');
            $table->nullableTimestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('viewCount')->default(0);
            $table->string('title');
            $table->string('slag');
            $table->longText('body');
            $table->integer('creator_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('m_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('imagePath');
            $table->integer('imageSize');
            $table->timestamps();
        });


        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('viewCount')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->boolean('approved')->default(0);
            $table->text('comment');
            $table->integer('commentable_id')->unsigned();
            $table->string('commentable_type');
            $table->timestamps();

        });

        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->float('commission')->default(0);
            $table->string('type');//type=(Discount=1,reseller_Discount,reseller)
            $table->string('calc_mode');//mode=(MAX,MIN,VALUE,PERCENT)
            $table->float('percent')->default(0);
            $table->float('value',12,4)->default(0);
            $table->integer('numbers')->default(0);
            //marketer who benefit from discount or reseller
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('users_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name_family');
            $table->string('phone_number',40)->nullable();
            $table->string('mobile_number',40)->nullable();
            $table->string('country');
            $table->string('province');
            $table->string('city');
            $table->string('address')->nullable();
            $table->string('postal_code');
            $table->string('email');
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('info_user_id')->unsigned()->index();
            $table->foreign('info_user_id')->references('id')->on('info_users');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('users_address_id')->unsigned()->index();
            $table->foreign('users_address_id')->references('id')->on('users_addresses');
            $table->smallInteger('pay_method');//0=didn't pay/1=cash/2=check/
            $table->timestamps();
        });

        Schema::create('baskets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('children_id')->unsigned()->default(0);
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->longText('content');
            $table->integer('discount_id')->unsigned()->index();
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->float('price')->nullable();
            $table->float('tax')->nullable();
            $table->float('total_discount')->nullable();
            $table->float('paid')->nullable();
            $table->smallInteger('basket_type')->default('0');//normal=0,refund=1
            $table->smallInteger('status')->default('0');//disapproved=0,suspend=1,approved=2
            $table->nullableTimestamps();
        });


        Schema::create('stuffs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basket_id')->unsigned()->index();
            $table->foreign('basket_id')->references('id')->on('baskets');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('qty');
            $table->float('price');
            $table->float('tax');
            $table->float('total_price');
            $table->float('discount',8,4);
            $table->string('discount_description');
            $table->integer('discount_code');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('info_users');
        Schema::dropIfExists('products');
        Schema::dropIfExists('password_resets');
        Schema::drop(config('cart.database.table'));
        Schema::dropIfExists('categories');
        Schema::dropIfExists('images');
        Schema::drop('category_product');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('stuffs');
        Schema::dropIfExists('baskets');
        Schema::dropIfExists('users_addresses');
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('orders');

    }
}
