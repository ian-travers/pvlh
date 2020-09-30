<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body class="text-center">
<div class="mt-4">
    <h2>Информационная система "План выдачи локомотивов на хозяйственные работы"</h2>
</div>
<div class="px-5 py-3">
    <p class="h5">
        Заказчик и отвественный по проекту&nbsp;&mdash; отдел сигнализации, связи и путевого хозяйства УП&nbsp;"Витебское
        отделение Белорусской железной дороги".
    </p>
    <p class="h5">
        Разработчик&nbsp;&mdash; информационно-вычислительный центр УП&nbsp;"Витебское отделение Белорусской железной
        дороги".
    </p>
    <p class="h5">
        Краткое наименование: ИС "ПВЛХ".
    </p>
    <p class="mt-3">ИС "ПВЛХ" предназначена для организации рационального посуточного планирования выдачи локомотивов
        для выполнения хозяйственных работ в "окна" ПЧ, ПМС.
    <p>
</div>
<div class="mb-3 text-black-50 lead">
        Работа с ИС "ПВЛХ" возможна только для авторизованных пользователей. Вы можете войти в систему или зарегистрироваться в ней.
</div>
<div>
    <a href="{{ route('login') }}" class="btn btn-lg btn-primary w-25 py-4">Вход</a>
    <a href="{{ route('register') }}" class="btn btn-lg btn-success w-25 py-4">Регистрация</a>
</div>
</body>
</html>
