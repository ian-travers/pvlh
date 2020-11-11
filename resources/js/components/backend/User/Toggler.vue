<template>
    <button
        type="button"
        class="btn py-0"
        @click="toggleNotification"
        :disabled="!hasVerifiedEmail"
        :title="setTitle"
    >
        <span
            :class="classes"
        ></span>
    </button>
</template>

<script>
export default {
    props: ['id', 'urlSuffix', 'isNotified', 'isVerifiedEmail'],

    data() {
        return {
            userId: this.id,
            hasVerifiedEmail: this.isVerifiedEmail,
            hasNotification: this.isNotified,
        }
    },

    methods: {
        toggleNotification() {
            axios.patch(`/a/users/${this.userId}/${this.urlSuffix}`)
                .then(response => {
                    this.hasNotification = !this.hasNotification;
                    iziToast.success({
                        title: response.data.title,
                        message: response.data.message,
                    });
                })
                .catch(error => {
                    iziToast.warning({
                        title: error.response.data.title,
                        message: error.response.data.message,
                    })
                });
        },
    },

    computed: {
        classes() {
            if (this.urlSuffix === 'toggle-bn')
                return ['fab fa-chrome', this.hasNotification ? 'text-success' : 'text-secondary'];

            if (this.urlSuffix === 'toggle-en')
                return ['fa fa-at', this.hasNotification ? 'text-success' : 'text-secondary'];
        },

        setTitle() {
            if (this.urlSuffix === 'toggle-bn')
                return 'Браузер';

            if (this.urlSuffix === 'toggle-en')
                return 'Электронная почта';
        }
    },
}
</script>
