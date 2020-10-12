<template>
    <button
        type="button"
        class="btn py-0"
        @click="toggleEmailNotification"
        :disabled="!hasVerifiedEmail"
    >
        <span
            :class="classes"
        ></span>
    </button>
</template>

<script>
export default {
    props: ['data'],

    data() {
        return {
            userId: this.data.id,
            hasVerifiedEmail: this.data.email_verified_at,
            hasEN: this.data.is_email_notified,
        }
    },

    methods: {
        toggleEmailNotification() {
            axios.patch(`/a/users/${this.userId}/toggle-en`)
                .then(response => {
                    this.hasEN = !this.hasEN;
                    iziToast.success({
                        title: response.data.title,
                        message: response.data.message,
                    });
                });
        },
    },

    computed: {
        classes() {
            return ['fa', 'fa-at', this.hasEN ? 'text-success' : 'text-secondary'];
        }
    },
}
</script>

<style scoped>

</style>
