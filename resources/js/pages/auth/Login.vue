<template>
    <!-- Container -->

    <div class="grid min-h-screen place-items-center">
        <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
            <h1 class="text-xl text-center font-semibold"><span class="font-normal">Devam edebilmek için lütfen giriş bilgilerinizi giriniz.</span></h1>
            <form class="mt-6" @submit.prevent="loginCheck()">
                <label for="email" class="block text-xs font-semibold text-gray-600 uppercase">E-mail</label>
                <input id="email" type="email" name="email" v-model="login.email" placeholder="E-mail adresinizi giriniz." autocomplete="email" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" />
                <validation-errors-help :status="this.status" :errors="this.errors" field-value="email"/>
                <label for="password" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Şifre</label>
                <input id="password" type="password" v-model="login.password" name="password" placeholder="********" autocomplete="password" class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner" />
                <validation-errors-help :status="this.status" :errors="this.errors" field-value="password"/>
                <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Giriş Yap
                </button>
                <p class="flex justify-between inline-block mt-4 text-xs text-gray-500 cursor-pointer hover:text-black">Şifremi unuttum?</p>
            </form>
        </div>
    </div>

</template>


<script>

    import ValidationErrors from "../../shared/ValidationErrors";
    import ValidationErrorsHelp from "../../shared/ValidationErrorsHelp";

    export default {
        data() {
            return {
                login : {
                    email : '',
                    password : '',
                },
                errors : null,
                status : null,
            }
        },
        components : {
            ValidationErrors,
            ValidationErrorsHelp
        },
        methods : {
            loginCheck : function () {
                this.errors = null;
                let email = this.login.email;
                let password = this.login.password;
                let device_name = 'web';

                this.$store.dispatch('login',{ email , password , device_name })
                    .then(() => this.$router.push('/yonetim'))
                    .catch(err => {
                        if(422 === err.status){
                            this.errors = err.errors;
                        }
                        this.status = err.status;
                    })
            },
        },

    }
</script>
