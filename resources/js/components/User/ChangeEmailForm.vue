<template>
    <div>
        <div class="form-group">
            <label for="email">Адрес email</label>
            <input type="text" name="email" id="email"
                   class="form-control"
                   v-model="data"
                   required>
        </div>
        <button type="button" class="btn btn-primary float-right" @click="changeEmail">Сохранить адрес email</button>
    </div>
</template>

<script>
    export default {
        props: ['email'],

        data() {
            return {
                data: this.email
            }
        },

        methods: {
            changeEmail() {
                axios.post('/profile/email', {email: this.data})
                    .then(response => {
                        iziToast.success({title: response.data.title, message: response.data.message});
                    })
                    .catch(error => {
                        // console.log(error.response.data.errors.email[0]);
                        if (typeof error.response == 'undefined') {
                            return;
                        }

                        iziToast.warning({title: "Предупреждение!", message: "Адрес '" + this.data + "' уже занят."});
                        this.data = this.email;
                    });
            }
        }
    }
</script>
