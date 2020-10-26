<template>

</template>

<script>
export default {
    props: ['data'],

    mounted() {
        if (this.data) {
            const content = JSON.parse(this.data);

            switch (content.level) {
                case 'success' :
                    iziToast.success({title: content.title, message: content.message});
                    break;
                case 'warning' :
                    iziToast.warning({title: content.title, message: content.message});
                    break;
                case 'error' :
                    iziToast.error({title: content.title, message: content.message});
                    break;
                case 'info' :
                    iziToast.info({title: content.title, message: content.message});
                    break;
                default:
                    iziToast.success({title: content.title, message: content.message});
            }
        }
    }
}
</script>
