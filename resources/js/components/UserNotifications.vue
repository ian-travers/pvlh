<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a id="navbarDropdown" class="nav-link" href="#" role="button"
           data-toggle="dropdown">
            <div class="d-inline-block px-2" style="padding-top: .15rem"><span class="h1 fas fa-bell"></span></div>
            <div class="position-absolute bg-danger text-center text-light rounded-circle"
                 style="min-width: 1.5rem; top: 4px; right: 4px" v-text="notifications.length"></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right py-0" style="min-width: 12rem" aria-labelledby="navbarDropdown">
            <div v-for="(notification, index) in notifications" class="">
                <a
                    class="dropdown-item"
                    :href="notification.data.link"
                    @click="markAsRead(notification)"
                >
                    <div class="text-center lead" v-text="notification.data.action"></div>
                    <div v-if="notification.data.customer">
                        <span class="fas fa-building"></span>
                        <span v-text="notification.data.customer"></span>
                        <span class="fas fa-address-card"></span>
                        <span v-text="notification.data.username"></span>
                    </div>
                    <div class="text-center" v-if="notification.data.department">
                        <span class="lead" v-text="notification.data.department"></span>
                    </div>
                    <div class="small my-1 text-right" v-text="appDate(notification.created_at)"></div>
                </a>
                <hr v-if="index < notifications.length - 1" class="my-0">
            </div>
        </div>
    </li>
</template>

<script>
    import moment from 'moment';

    export default {
        props: [],

        data() {
            return {
                notifications: [],
            }
        },

        created() {
            axios.get('/notifications')
                .then(response => {
                    this.notifications = response.data;
                });
        },

        methods: {
            markAsRead(notification) {
                axios.delete(`/notifications/${notification.id}`);
            },

            appDate(qdate) {
                moment.locale('ru');
                return moment(qdate).fromNow();
            },
        },
    }
</script>
