<template>
    <admin-layout>


        <Spinner v-if="!loading"/>

        <div v-else>
            <div class="mt-8">
                <div class="mt-4">
                    <div class="p-6 bg-white rounded-md shadow-md">
                        <h2 class="text-lg text-gray-700 font-semibold capitalize">Kişisel Bilgilerim</h2>

                        <form>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="first_last_name">Ad Soyad</label>
                                    <input v-model="settingsForms.first_last_name"
                                           @change="updateSettings('first_last_name',settingsForms.first_last_name)"
                                           class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="first_last_name"
                                           name="first_last_name" type="text" required="" placeholder="Ad Soyad"
                                           aria-label="Ad Soyad">
                                </div>

                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="email_adress">E-mail adresim</label>
                                    <input v-model="settingsForms.email_adress"
                                           @change="updateSettings('email_adress',settingsForms.email_adress)"
                                           class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="email_adress"
                                           name="email_adress" type="text" required="" placeholder="E-mail Adresim"
                                           aria-label="E-mail">
                                </div>

                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="job_title">Meslek</label>
                                    <input v-model="settingsForms.job_title"
                                           @change="updateSettings('job_title',settingsForms.job_title)"
                                           class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="job_title"
                                           name="job_title" type="text" required="" placeholder="Meslek" aria-label="Meslek">
                                </div>

                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-gray-600" for="profile_image">Resim</label>
                                    <input class="w-full px-5 text-gray-700 bg-gray-200 rounded" @change="selectImage" id="profile_image"
                                           name="profile_image" type="file" required="" aria-label="Verification">
                                </div>
                                <div>
                                    <img class="rounded-lg md:w-56" v-if="settingsForms.profile_image" :src="settingsForms.profile_image" alt="Profil Resmi">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <div class="mt-4">
                    <div class="p-6 bg-white rounded-md shadow-md">
                        <h2 class="text-lg text-gray-700 font-semibold capitalize">Site Ayarları</h2>

                        <form>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="site_name">Site Adı</label>
                                    <input v-model="settingsForms.site_name"
                                           @change="updateSettings('site_name',settingsForms.site_name)"
                                           class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="site_name"
                                           name="site_name" type="text" required="" placeholder="Site Adı" aria-label="Ad">
                                </div>

                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="site_description">Site Açıklaması</label>
                                    <input v-model="settingsForms.site_description"
                                           @change="updateSettings('site_description',settingsForms.site_description)"
                                           class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="site_description"
                                           name="site_description" type="text" required="" placeholder="Site Açıklaması"
                                           aria-label="Açıklama">
                                </div>

                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="site_verification">Verification
                                        Kodları</label>
                                    <input v-model="settingsForms.site_verification"
                                           @change="updateSettings('site_verification',settingsForms.site_verification)"
                                           class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="site_verification"
                                           name="site_verification" type="text" required=""
                                           placeholder="Site Verification Kodları" aria-label="Verification">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <div class="mt-4">
                    <div class="p-6 bg-white rounded-md shadow-md">
                        <h2 class="text-lg text-gray-700 font-semibold capitalize">Sosyal Medya Hesapları</h2>

                        <form>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="site_linkedin">Linkedin Adresi</label>
                                    <input v-model="settingsForms.site_linkedin"
                                           @change="updateSettings('site_linkedin',settingsForms.site_linkedin)"
                                           class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="site_linkedin"
                                           name="site_linkedin" type="text" required="" placeholder="Linkedin Adresi"
                                           aria-label="Linkedin">
                                </div>

                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="site_instagram">Instagram Adresi</label>
                                    <input v-model="settingsForms.site_instagram"
                                           @change="updateSettings('site_instagram',settingsForms.site_instagram)"
                                           class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="site_instagram"
                                           name="site_instagram" type="text" required="" placeholder="Instagram Adresi"
                                           aria-label="Instagram">
                                </div>

                                <div
                                    class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                    <label class="block text-sm text-black" for="site_github">Github Adresi</label>
                                    <input v-model="settingsForms.site_github"
                                           @change="updateSettings('site_github',settingsForms.site_github)"
                                           class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="site_github"
                                           name="site_github" type="text" required="" placeholder="Github Adresi"
                                           aria-label="Github">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "../../../layout/AdminLayout";
    import {VueEditor} from "vue2-editor";
    import vueDropzone from "vue2-dropzone";
    import Spinner from "../../../components/Spinner";

    export default {
        components: {
            Spinner,
            AdminLayout,
        },
        data() {
            return {
                loading: false,
                settingsForms: {},
                profile_image : '',
            }
        },
        mounted() {
            this.loading = false;
            var token = localStorage.getItem('token');
            axios.get('/settings', {headers: {Authorization: `Bearer ${token}`}}).then(response => {
                this.loading = true;
                this.settingsForms = response.data;
            }).catch(error => {
                console.log(error);
            })
        },
        methods: {
            selectImage: function(event){
                var formData = new FormData();
                formData.append("image", event.target.files[0]);
                formData.append("folderName", 'settings');

                const token = localStorage.getItem('token');
                axios({
                    url : 'upload-image',
                    method : "POST",
                    data: formData,
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.settingsForms.profile_image = response.data.data.image_url; // Get url from response
                    this.updateSettings('profile_image',this.settingsForms.profile_image);
                }).catch(error => {
                    console.log(error);
                });

            },
            updateSettings: function (variable, variableValue) {
                const token = localStorage.getItem('token');
                axios({
                    url: `/settings/${this.settingsForms.id}`,
                    method: "PUT",
                    data: {
                        'variable': variable,
                        'variableValue': variableValue,
                    },
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.settingsForms = response.data;
                    this.loading = true;
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>
