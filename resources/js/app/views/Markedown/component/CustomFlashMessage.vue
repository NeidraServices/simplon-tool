<template>    
    <FlashMessage :position="'top'" ></FlashMessage>
</template>
<script>
    export default {
        methods: {
            showMessageSuccess(msg){
                this.flashMessage.success({
                    message: msg,
                });
            },
            showMessageError(msg){
                this.flashMessage.error({
                    message: msg,
                });
            }
        }
    }
</script>