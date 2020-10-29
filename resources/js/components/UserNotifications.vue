<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a id="navbarDropdown" class="nav-link" href="#" role="button"
           data-toggle="dropdown">
            <div class="d-inline-block px-2" style="padding-top: .15rem"><span class="h1 fas fa-bell"></span></div>
            <div class="position-absolute bg-danger text-center text-light rounded-circle"
                 style="min-width: 1.5rem; top: 4px; right: 4px" v-text="notifications.length"></div>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <div v-for="notification in notifications">
                <a
                    class="dropdown-item"
                    :href="notification.data.link"
                    @click="markAsRead(notification)"
                >
                    <div class="text-center lead" v-text="notification.data.action"></div>
                    <div>
                        <span class="fas fa-building"></span>
                        <span v-text="notification.data.customer"></span>
                        <span class="fas fa-address-card"></span>
                        <span v-text="notification.data.username"></span>
                    </div>
                </a>
            </div>
        </div>
    </li>
</template>

<script>
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
        },
    }
</script>
