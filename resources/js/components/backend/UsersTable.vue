<template>
    <div>
        <!-- Modal Password Window -->
        <div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="pwdModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="pwdModalLabel">Смена пароля</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="userId" id="user-id" :value="this.userId">
                        <p class="text-center">Пользователь</p>
                        <p class="h1 text-center" v-text="this.username"></p>

                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input
                                type="text"
                                id="password"
                                name="password"
                                class="form-control"
                                v-model="password"
                            >
                            <span class="invalid-feedback" id="password-check-error"
                                  role="alert"><strong
                                id="password-check-error-message"></strong></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-end border-top pt-3">
                            <button type="button" class="btn btn-lg btn-primary" @click="changePassword">Сменить пароль
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Отменить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                        <toggler
                            :data="user"
                            url-suffix="toggle-bn"
                            :is-notified="user.is_browser_notified"
                            :is-verified-email="user.email_verified_at"
                        ></toggler>
                        <toggler
                            :data="user"
                            url-suffix="toggle-en"
                            :is-notified="user.is_email_notified"
                            :is-verified-email="user.email_verified_at"
                        ></toggler>
                    </td>
                    <td
                        class="text-center"
                        v-text="user.email_verified_at ? user.email_verified_at.substr(0, 10) : ''"
                    ></td>
                    <td class="text-center w-15">
                        <button
                            class="btn btn-sm btn-primary fa fa-user-edit"
                            title="Редактировать"
                            @click="edit(user)"
                        ></button>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary fa fa-user-check"
                            title="Верифицировать"
                            :disabled="!!user.email_verified_at"
                        ></button>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary fa fa-unlock-alt"
                            title="Сменить пароль"
                            @click="showPasswordWindow(user.id, user.name)"
                        ></button>
                        <button
                            type="button"
                            class="btn btn-sm btn-danger fa fa-trash-alt"
                            title="Удалить"
                            @click="deleteUser(user.id)"
                        ></button>
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
import Toggler from "./User/Toggler";

export default {
    props: ['data'],

    components: {Toggler},

    data() {
        return {
            paginator: JSON.parse(this.data),
            userId: null,
            username: null,
            password: '',
        }
    },

    mounted() {
        $('#pwdModal').on('show.bs.modal', function () {
            $('#password').removeClass('is-invalid');
        });
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

        edit(user) {
            window.location.href = `/a/users/${user.id}/edit`;
        },

        deleteUser(id) {
            if (confirm()) {
                axios.post('/a/users/delete', {userId: id})
                    .then(response => {
                        window.location.reload();
                    })
                    .catch(error => {
                        console.log(window.location.href);
                        iziToast.warning({
                            title: error.response.data.title,
                            message: error.response.data.message,
                        });
                    });
            }
        },

        showPasswordWindow(id, name) {
            this.userId = id;
            this.username = name;

            $('#pwdModal').modal('show');
        },

        changePassword() {
            axios.post("/a/users/change-password", {
                userId: this.userId,
                password: this.password,
            })
                .then(response => {
                    $('#pwdModal').modal('hide');
                    iziToast.success({title: response.data.title, message: response.data.message});
                })
                .catch(error => {
                    // console.log(error.response.data.errors);
                    let passwordCheck = $('#password');
                    let passwordCheckErrorMessage = $('#password-check-error-message');

                    if ('password' in error.response.data.errors) {
                        passwordCheck.addClass('is-invalid');
                        passwordCheckErrorMessage.html(error.response.data.errors.password[0]);
                    }

                    iziToast.warning({
                        title: "Предупреждение",
                        message: error.response.data.errors.password[0]
                    });
                });
        },
    }
}
</script>
