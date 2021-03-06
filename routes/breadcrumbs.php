<?php

/** @noinspection PhpUnhandledExceptionInspection */

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

Breadcrumbs::for('root', function (BreadcrumbsGenerator $trail) {
    $trail->push('Главная', route('applications'));
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

Breadcrumbs::for('backend.customers', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend');
    $trail->push('Заказчики', route('backend.customers'));
});

Breadcrumbs::for('backend.customers.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.customers');
    $trail->push('Создать');
});

Breadcrumbs::for('backend.customers.edit', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.customers');
    $trail->push('Редактировать');
});

Breadcrumbs::for('backend.depots', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend');
    $trail->push('Депо приписки', route('backend.depots'));
});

Breadcrumbs::for('backend.depots.create', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.depots');
    $trail->push('Создать');
});

Breadcrumbs::for('backend.depots.edit', function (BreadcrumbsGenerator $trail) {
    $trail->parent('backend.depots');
    $trail->push('Редактировать');
});
