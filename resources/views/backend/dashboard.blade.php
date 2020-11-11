<x-layout-backend title="Панель управления">
    <div class=""><h2>Панель управления</h2></div>
    <hr>
    <h3>Информация о пользователях системы</h3>
    <p>
        Зарегиcтрировано:
        <strong>{{ $usersInfo['countAll'] }}</strong>.
        Верифицировано:
        <strong>{{ $usersInfo['countVerified'] }}</strong>.
    </p>
    <hr>
    <h3>Информация о заявках на локомотивы</h3>
    <p>
        Всего заявок:
        <strong>{{ $locAppsInfo['countAll'] }}</strong>.
        Из них согласовано:
        <strong>{{ $locAppsInfo['countApproved'] }}</strong>.
    </p>
    <hr>
    <h3>Информация о количестве записей в справочниках системы (НСИ)</h3>
    <div>Справочник назначений: <strong>{{ $purposesCount }}</strong>.</div>
    <div>Справочник заказчиков: <strong>{{ $customersCount }}</strong>.</div>
    <div>Справочник депо: <strong>{{ $depotsCount }}</strong>.</div>
</x-layout-backend>
