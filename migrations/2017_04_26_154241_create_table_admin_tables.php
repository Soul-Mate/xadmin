<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdminTables extends Migration
{

    public function up()
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        Schema::connection($connection)->create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50)->unique();
            $table->string('password', 60);
            $table->string('email',40)->unique();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->engine = 'INNODB';
        });

        Schema::connection($connection)->create('admin_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->nullable();
            $table->string('description',255)->nullable();
            $table->timestamps();
            $table->engine = 'INNODB';
        });

        Schema::connection($connection)->create('admin_permissions', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->integer('order')->default(0);
            $table->string('uri', 150);
            $table->boolean("visit")->default(1)->nullable()->comment("是否显示在菜单栏: 0-否 1-是");        
            $table->string('icon', 50);
            $table->unsignedInteger('parent_id')->nullable();            
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('admin_permissions')->onDelete('cascade')->onUpdate('cascade');
            $table->engine = 'INNODB';
        });

        Schema::connection($connection)->create('admin_role_users', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('user_id');
            $table->primary(['role_id', 'user_id']);
            $table->foreign('role_id')->references('id')->on('admin_roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->engine = 'INNODB';
        });

        Schema::connection($connection)->create('admin_role_permissions', function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->primary(['role_id', 'permission_id']);
            $table->foreign('role_id')->references('id')->on('admin_roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('permission_id')->references('id')->on('admin_permissions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->engine = 'INNODB';
        });

        Schema::connection($connection)->create('admin_user_permissions', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('permission_id');
            $table->index(['user_id', 'permission_id']);
            $table->timestamps();
            $table->engine = 'INNODB';
        });

        Schema::connection($connection)->create('admin_login_logs',function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('name',50);
            $table->string('email',40);
            $table->string('country')->nullable()->comment('地区');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('城市');
            $table->string('ip',15)->nullable()->comment('ip地址');
            $table->timestamp('time')->comment('登陆时间');
            $table->unsignedInteger('times')->default(0)->comment('登陆时间');
        });

        return true;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_role_users');
        Schema::dropIfExists('admin_role_permissions');
        Schema::dropIfExists('admin_user_permissions');
        Schema::dropIfExists('admin_login_logs');
    }
}
