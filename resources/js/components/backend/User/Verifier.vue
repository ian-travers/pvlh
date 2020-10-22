<template>
    <button
        type="button"
        class="btn py-0"
        :title="title"
        :disabled="hasVerifiedEmail"
        @click="verify(userId)"
    >
        <span
            :class="classes"
        ></span>
    </button>
</template>

<script>
export default {
    props: ['id', 'isVerified'],

    data() {
        return {
            userId: this.id,
            hasVerifiedEmail: this.isVerified,
        }
    },

    computed: {
        classes() {
            return [this.hasVerifiedEmail ? 'fas fa-check-double text-success' : 'fa fa-user-check text-primary'];
        },

        title() {
            return this.hasVerifiedEmail ? 'Email подтвержден' : 'Верифицировать';
        }
    },

    methods: {
        verify(id) {
            if (confirm()) {
                axios.post('/a/users/verify', {userId: id})
                    .then(response => {
                        this.hasVerifiedEmail = true;
                        iziToast.success({title: response.data.title, message: response.data.message});
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
    }
}
</script>
