<template>
    <!-- Container -->
    <div class="container mx-auto">
            <div class="flex justify-center px-6 my-12">
                <!-- Row -->
                <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                    <!-- Col -->
                    <div
                        class="w-full h-auto bg-gray-400 hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                        style="background-image: url('https://images.unsplash.com/photo-1447069387593-a5de0862481e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1650&q=80')"
                    />
                    <!-- Col -->
                    <div class="w-full lg:w-1/2 bg-white p-5 rounded-lg lg:rounded-l-none border">
                        <h3 class="pt-4 text-2xl text-center">Giriş Yap</h3>
                        <form class="px-8 pt-6 pb-8 mb-4 mt-9 bg-white rounded" @submit.prevent="loginCheck()">
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                    E-mail
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="email"
                                    name="email"
                                    type="email"
                                    v-model="login.email"
                                    placeholder="E-mail"
                                />
                                <validation-errors-help :status="this.status" :errors="this.errors" field-value="email"/>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Şifre
                                </label>
                                <input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password"
                                    type="password"
                                    name="password"
                                    v-model="login.password"
                                    placeholder="Şifrenizi giriniz"
                                />
                                <validation-errors-help :status="this.status" :errors="this.errors" field-value="password"/>
                            </div>
                            <div class="mb-6 text-center">
                                <button
                                    class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                    type="submit"
                                >
                                    Giriş Yap
                                </button>
                            </div>
                            <hr class="mb-6 border-t" />
                        </form>
                    </div>
                </div>
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
