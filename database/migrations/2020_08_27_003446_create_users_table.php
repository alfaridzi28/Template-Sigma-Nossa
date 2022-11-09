<?php

use App\Log;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;

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
            $table->bigIncrements('id');
            $table->string('username', 128);
            $table->string('password', 128)->nullable();
            $table->text('description')->nullable();
            $table->text('module')->nullable();
            $table->enum('role', ['superadmin', 'admin', 'user', 'DSO', 'Default LDAP', 'roc'])->default('user');
            $table->boolean('active')->default('true');
            $table->text('active_reason')->nullable();
            $table->boolean('ldap')->nullable();
            $table->string('telegram_id')->nullable();
            $table->boolean('is_ldap_and_signed_in')->nullable();
            $table->timestamps();
        });

        User::create([
            'username'      => 'superadmin',
            'password'      => sha1('bukanscmttools'),
            'description'   => 'Super Admin Account',
            'module'        => 'all',
            'role'          => 'superadmin',
        ]);

        User::create([
            'username'      => 'user',
            'password'      => sha1('secret1234'),
            'description'   => 'User Account for Search Item',
            'module'        => 'search-item',
            'role'          => 'superadmin',
        ]);

        User::create([
            'username'      => 'userroc',
            'password'      => sha1('userroc123'),
            'description'   => 'User Account for Search Item',
            'module'        => 'sqm-predictive-logic',
            'role'          => 'roc',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
