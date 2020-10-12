<template>
    <div>
        <div v-if="hasUsers">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="w-5 text-center">ID</th>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Адрес email</th>
                    <th class="text-center">Уведомления</th>
                    <th class="text-center">Верификация</th>
                    <th class="text-center">Операции</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in paginator.data">
                    <td class="text-center" v-text="user.id"></td>
                    <td v-text="user.name"></td>
                    <td v-text="user.position"></td>
                    <td v-text="user.email"></td>
                    <td class="text-center">
                        <toggle-browser-notification :data="user"></toggle-browser-notification>
                        <toggle-email-notification :data="user"></toggle-email-notification>
                    </td>
                    <td
                        class="text-center"
                        v-text="user.email_verified_at ? user.email_verified_at.substr(0, 10) : ''"></td>
                    <td class="text-center w-15">
                        <a
                            href="#"
                            class="btn btn-sm btn-primary fa fa-user-edit"
                            title="Редактировать">
                        </a>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary fa fa-user-check"
                            title="Верифицировать"
                            :disabled="!!user.email_verified_at"
                        ></button>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary fa fa-unlock-alt"
                            title="Сменить пароль">
                        </button>
                        <button
                            type="button"
                            class="btn btn-sm btn-danger fa fa-trash-alt"
                            title="Удалить">
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <nav v-if="hasPages">
                <ul class="pagination">
                    <li v-for="link in paginator.links" class="page-item"
                        :class="(link.active || !link.url) ? 'disabled' : ''">
                        <a class="page-link" :href="link.url" v-html="linkText(link.label)"></a>
                    </li>
                </ul>
            </nav>
        </div>
        <div v-else>There is no users.</div>
    </div>
</template>

<script>
import ToggleBrowserNotification from "./User/ToggleBrowserNotification";
import ToggleEmailNotification from "./User/ToggleEmailNotification";

export default {
    props: ['data'],

    components: { ToggleBrowserNotification, ToggleEmailNotification },

    data() {
        return {
            paginator: JSON.parse(this.data),
        }
    },

    computed: {
        hasUsers() {
            return !!this.paginator.total;
        },

        hasPages() {
            return this.paginator.last_page > 1;
        },
    },

    methods: {
        linkText(label) {
            if (label === "Previous") return "&lsaquo;"
            if (label === "Next") return "&rsaquo;"
            return label;
        },
    }
}
</script>
