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
</x-layout-backend>
