<template>
    <button
        type="button"
        class="btn py-0"
        @click="toggleBrowserNotification"
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
            hasBN: this.data.is_browser_notified,
        }
    },

    methods: {
        toggleBrowserNotification() {
            axios.patch(`/a/users/${this.userId}/toggle-bn`)
                .then(response => {
                    this.hasBN = !this.hasBN;
                    iziToast.success({
                        title: response.data.title,
                        message: response.data.message,
                    });
                });
        },
    },

    computed: {
        classes() {
            return ['fab', 'fa-chrome', this.hasBN ? 'text-success' : 'text-secondary'];
        }
    },
}
</script>

<style scoped>

</style>
