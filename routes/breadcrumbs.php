<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator as Generator;
use App\Models\User;
use App\Models\Adverts\Region;

// Home
Breadcrumbs::for('home', static function (Generator $trail) {
    $trail->push(__('Home'), route('home'));
});
// Login
Breadcrumbs::for('login', static function (Generator $trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});
// Register
Breadcrumbs::for('register', static function (Generator $trail) {
    $trail->parent('home');
    $trail->push(__('Register'), route('register'));
});
// Reset Password
Breadcrumbs::for('password.request', static function (Generator $trail) {
    $trail->parent('login');
    $trail->push('Reset Password', route('password.request'));
});
// Cabinet
Breadcrumbs::for('cabinet.home', static function (Generator $trail) {
    $trail->parent('home');
    $trail->push('Cabinet', route('cabinet.home'));
});
// Admin home
Breadcrumbs::for('admin.home', static function (Generator $trail) {
    $trail->push(__('Dashboard'), route('admin.home'));
});
// Admin users
Breadcrumbs::for('admin.users.index', static function (Generator $trail) {
    $trail->parent('admin.home');
    $trail->push('Users', route('admin.users.index'));
});

Breadcrumbs::for('admin.users.create', static function (Generator $trail) {
    $trail->parent('admin.users.index');
    $trail->push(__('Create'), route('admin.users.create'));
});

Breadcrumbs::for('admin.users.show', static function (Generator $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});
// Admin Adverts Regions
Breadcrumbs::for('admin.adverts.regions.index', static function (Generator $trail) {
    $trail->parent('admin.home');
    $trail->push(__('Regions'), route('admin.adverts.regions.index'));
});

Breadcrumbs::for('admin.adverts.regions.create', static function (Generator $trail) {
    $trail->parent('admin.adverts.regions.index');
    $trail->push(__('Create'), route('admin.adverts.regions.create'));
});

Breadcrumbs::for('admin.adverts.regions.show', static function (Generator $trail, Region $region) {
    if ($parent = $region->parent) {
        $trail->parent('admin.adverts.regions.show', $parent);
    } else {
        $trail->parent('admin.adverts.regions.index');
    }

    $trail->push($region->name, route('admin.adverts.regions.show', $region));
});

Breadcrumbs::for('admin.adverts.regions.edit', static function (Generator $trail, Region $region) {
    $trail->parent('admin.adverts.regions.show', $region);
    $trail->push(__('Edit'), route('admin.adverts.regions.edit', $region));
});

// Admin Blog Category
Breadcrumbs::for('admin.blog.categories.index', static function ($trail) {
    $trail->parent('home');
    $trail->push(__('Categories'), route('admin.blog.categories.index'));
});
Breadcrumbs::for('admin.blog.categories.edit', static function (Generator $trail, $id) {
    $trail->parent('admin.blog.categories.index');
    $trail->push(__('Edit'), route('admin.blog.categories.edit', $id));
});
Breadcrumbs::for('admin.blog.categories.create', static function (Generator $trail) {
    $trail->parent('admin.blog.categories.index');
    $trail->push(__('Create'), route('admin.blog.categories.create'));
});
// Admin Blog Posts
Breadcrumbs::for('admin.blog.posts.index', static function ($trail) {
    $trail->parent('home');
    $trail->push(__('Posts'), route('admin.blog.posts.index'));
});
Breadcrumbs::for('admin.blog.posts.edit', static function (Generator $trail, $id) {
    $trail->parent('admin.blog.posts.index');
    $trail->push(__('Edit'), route('admin.blog.posts.edit', $id));
});
Breadcrumbs::for('admin.blog.posts.create', static function (Generator $trail) {
    $trail->parent('admin.blog.posts.index');
    $trail->push(__('Create'), route('admin.blog.posts.create'));
});
