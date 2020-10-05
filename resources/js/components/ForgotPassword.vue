<template>
    <form style="display: none"  id="frmResetPassword" autocomplete="off" @submit.prevent="requestResetPassword()" method="post">
        <div class="xs-input-group-v2">
            <i class="icon icon-profile-male"></i>
            <input type="email" name="email"  id="email" class="xs-input-control" v-model="email" required autofocus>
        </div>
        <span class="invalid-feedback mesajesError d-block" role="alert">
                            <strong id="error-email"></strong>
                        </span>

        <div class="xs-submit-wraper xs-mb-20">
            <input type="submit" name="submit"  value="resetiar" id="xs_contact_get_action" class="btn btn-warning btn-block">
        </div>
        <p class="text-center">
            <a href="#" class="btn_volvel_login">login</a>
        </p>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
                has_error: false
            }
        },
        methods: {
            requestResetPassword() {
                axios.post("/password/email", {email: this.email}).then(result => {
                    this.response = result.data;
                    modal_login();
                    swal.fire({
                        position: 'center',
                        type: 'success',
                        title: Text_reset,
                        showConfirmButton: false,
                        timer: 3800,
                        customClass: {
                            title: 'title-class',
                        }
                    });
                    console.log(result.data);
                }, error => {
                    console.error(error);
                });
            }
        }
    }
</script>
<style>
    .title-class {
        font-size: 17px !important;
    }
</style>

