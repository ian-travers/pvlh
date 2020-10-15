<?php

/** @noinspection PhpUnhandledExceptionInspection */

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::for('root', function (BreadcrumbsGenerator $trail) {
    $trail->push('Главная', route('root'));
});

// Backend stuff
Breadcrumbs::for('backend', function (BreadcrumbsGenerator $trail) {
    $trail->parent('root');
    $trail->push('Панель управления', route('backend'));
});

Breadcrumbs::for('backend.users', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend');
    $trail->push('Пользователи', route('backend.users'));
});

Breadcrumbs::for('backend.users.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.users');
    $trail->push('Создать');
});

Breadcrumbs::for('backend.users.edit', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.users');
    $trail->push('Редактировать');
});

Breadcrumbs::for('backend.purposes', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend');
    $trail->push('Назначения', route('backend.purposes'));
});

Breadcrumbs::for('backend.purposes.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.purposes');
    $trail->push('Создать');
});

Breadcrumbs::for('backend.purposes.edit', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.purposes');
    $trail->push('Редактировать');
});
