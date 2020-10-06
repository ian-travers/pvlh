<template>
    <div>
        <div class="form-group">
            <label for="name" class="font-weight-bolder">Имя</label>
            <input type="text" name="name" id="name"
                   class="form-control" v-model="data.name"
                   required autocomplete="name" autofocus>
        </div>
        <div class="form-group">
            <label for="position" class="font-weight-bolder">Должность</label>
            <input type="text" name="position" id="position"
                   class="form-control" v-model="data.position"
                   required autocomplete="position">
        </div>
        <div class="border p-2 mb-3">
            <h3>Система уведомлений</h3>
            При создании, согласовании, утверждении заявки система может рассылать уведомления своим
            пользователям. Выберите уведомления, которые хотите получать:
            <div class="form-check mt-2">
                <input type="checkbox" name="is_browser_notified" id="notify-browser"
                       class="form-check-input"
                       :checked="data.is_browser_notified"
                       v-model="data.is_browser_notified">
                <label for="notify-browser" class="font-weight-bolder">Получать уведомления в
                    браузере</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="is_email_notified" id="notify-email"
                       class="form-check-input"
                       :checked="data.is_email_notified"
                       v-model="data.is_email_notified">
                <label for="notify-email" class="font-weight-bolder">Получать уведомления по электронной
                    почте</label>
            </div>
        </div>
        <button type="button" class="btn btn-primary float-right" @click="update">Сохранить</button>
    </div>
</template>

<script>
    export default {
        name: "edit-profile-form",

        props: ['user'],

        data() {
            return {
                data: this.user,
            }
        },

        methods: {
            update() {
                axios.post('/profile', this.data)
                    .then(response => {
                        iziToast.success({title: response.data.title, message: response.data.message});
                    });
            }
        }
    }
</script>
