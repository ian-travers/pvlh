<template>
    <div>
        <button type="button" data-toggle="modal" data-target="#changePasswordForm"
                class="btn btn-dark float-right">
            Изменить пароль...
        </button>
        <!--        Modal form-->
        <div id="changePasswordForm" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Изменение пароля</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="password">Новый пароль</label>
                            <input type="password" name="password" id="password"
                                   class="form-control"
                                   v-model="password"
                                   required>
                            <span class="invalid-feedback" id="password-error"
                                  role="alert"><strong id="password-error-message"></strong></span>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Повтор пароля</label>
                            <input type="password" name="password_confirmation" id="password-confirm"
                                   class="form-control"
                                   v-model="passwordConformation"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer d-block">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" @click="submitForm">
                                Сохранить новый пароль
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                password: '',
                passwordConformation: '',
            }
        },
        methods: {
            submitForm() {
                axios.post('/profile/password', {
                    password: this.password,
                    password_confirmation: this.passwordConformation
                })
                    .then(response => {
                        iziToast.success({title: response.data.title, message: response.data.message});
                        $('#changePasswordForm').modal('hide');
                    })
                    .catch(error => {
                        if (error.response) {
                            $('#password').addClass('is-invalid');
                            $('#password-error-message').html(error.response.data.errors.password[0]);
                        }
                    });
            }
        }
    }
</script>
