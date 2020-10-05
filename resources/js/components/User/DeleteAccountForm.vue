<template>
    <div>
        <button type="button" data-toggle="modal" data-target="#deleteAccountForm"
                class="btn btn-danger float-right">
            Удалить вашу учетную запись...
        </button>
        <!--        Modal form-->
        <div id="deleteAccountForm" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-html="question"></h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" role="alert">
                            Это очень важно. После удаления отменить эту оперцию будет
                            невозможно!
                        </div>
                        <div class="form-group">
                            <label for="password-check">Подтвердите своим паролем</label>
                            <input type="password" name="passwordCheck" id="password-check"
                                   class="form-control"
                                   required>
                            <span class="invalid-feedback" id="password-check-error"
                                  role="alert"><strong
                                id="password-check-error-message"></strong></span>
                        </div>
                        <div class="form-group">
                            <label for="verify-phrase">
                                Для проверки наберите
                                <em class="font-weight-normal">delete my account</em>
                                в строке ниже:
                            </label>
                            <input type="text" name="verifyPhrase" id="verify-phrase"
                                   class="form-control"
                                   required>
                            <span class="invalid-feedback" id="verify-phrase-error"
                                  role="alert"><strong id="verify-phrase-error-message"></strong></span>
                        </div>

                    </div>
                    <div class="modal-footer d-block">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" @click="deleteAccount">
                                Удалить аккаунт
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
        props: ['name'],

        computed: {
            question() {
                return '<strong>' + this.name + '</strong>, уверены, что хотите удалить свою учетную запись?'
            }
        },

        methods: {
            deleteAccount() {
                axios.post('/profile/delete', {
                    passwordCheck: $('#password-check').val(),
                    verifyPhrase: $('#verify-phrase').val()
                })
                    .then(response => {
                        $('#deleteAccountForm').modal('hide');
                        iziToast.success({title: response.data.title, message: response.data.message});
                        setTimeout(function () {
                            window.location = location.origin;
                        }, 1500);
                    })
                    .catch(error => {

                        if (error.response.status == 409) {
                            iziToast.error({title: error.response.data.title, message: error.response.data.message});
                            return;
                        }

                        if (error.response) {
                            let passwordCheck = $('#password-check');
                            let passwordCheckErrorMessage = $('#password-check-error-message');
                            let verifyPhrase = $('#verify-phrase');
                            let verifyPhraseErrorMessage = $('#verify-phrase-error-message');

                            passwordCheck.removeClass('is-invalid');
                            passwordCheckErrorMessage.html('');
                            verifyPhrase.removeClass('is-invalid');
                            verifyPhraseErrorMessage.html('');

                            if ('passwordCheck' in error.response.data.errors) {
                                passwordCheck.addClass('is-invalid');
                                passwordCheckErrorMessage.html(error.response.data.errors.passwordCheck[0]);
                            }

                            if ('verifyPhrase' in error.response.data.errors) {
                                verifyPhrase.addClass('is-invalid');
                                verifyPhraseErrorMessage.html(error.response.data.errors.verifyPhrase[0]);
                            }
                        }
                    });
            }
        }
    }
</script>
