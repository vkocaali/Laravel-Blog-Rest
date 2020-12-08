<template>
    <admin-layout>
        <div class="mt-8">
            <div class="mt-4">
                <div class="p-6 bg-white rounded-md shadow-md">
                    <a @click="$router.go(-1)" class="text-sm cursor-pointer  bg-indigo-500 hover:bg-indigo-700 float-right text-white font-bold py-2 px-4 rounded-full ">
                        Geri Dön
                    </a>


                    <h2 class="text-lg text-gray-700 font-semibold capitalize">Kategori Düzenle</h2>

                    <div v-if="success" class="mt-5 bg-green-300 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
                        <div class="flex">
                            <div class="py-1"><svg class="fill-current h-6 w-6 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                            <div>
                                <p class="font-bold">Başarılı</p>
                                <p class="text-sm">Güncelleme işlemi başarılı.</p>
                            </div>
                        </div>
                    </div>

                    <form v-on:submit.prevent="updateCategoriesSubmit">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="name">Kategori Adı</label>
                                <input v-model="categories.name" @keyup="sanitizeTitle(categories.name)"
                                       class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
                                       name="name" type="text" placeholder="Kategori Adı"
                                       aria-label="Kategori Adı">
                                <validation-errors-help class="my-2 mx-1" :status="this.status" :errors="this.errors" field-value="name"/>
                            </div>

                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="description">Kategori Açıklaması</label>
                                <input v-model="categories.description"
                                       class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="description"
                                       name="description" type="text" placeholder="Kategori Açıklaması"
                                       aria-label="Kategori Açıklaması">
                                <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="description"/>
                            </div>

                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="slug">Slug</label>
                                <input v-model="categories.slug"
                                       class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="slug"
                                       name="slug" type="text" placeholder="Slug" aria-label="Slug">
                                <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="slug"/>
                            </div>

                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="tag">Kategori Etiketleri</label>
                                <vue-tags-input id="tag" v-model="tag" :tags="categories.tags"
                                                @tags-changed="newTags => categories.tags = newTags"/>
                                <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="tags"/>

                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 mt-4">
                            <div>
                                <label class="block text-sm text-gray-600" for="editor">Kategori İçeriği</label>
                                <vue-editor id="editor" useCustomImageHandler
                                            @image-added="handleImageAdded"
                                            v-model="categories.content"/>
                                <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="content"/>
                            </div>
                        </div>

                        <div
                            class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                            <label class="block text-sm text-gray-600" for="image">Kategori Resmi</label>
                            <input class="w-full px-5 text-gray-700 bg-gray-200 rounded" @change="selectImage" id="image"
                                   name="image" type="file" aria-label="Kategori Resim">
                            <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="image"/>
                        </div>

                        <div>
                            <img class="rounded-lg md:w-56" v-if="this.imagePreview" :src="this.imagePreview" alt="Kategori Resmi">
                        </div>





                        <div class="flex justify-end mt-4">
                            <button class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Kaydet</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>



    </admin-layout>
</template>

<script>
    import AdminLayout from "../../../layout/AdminLayout";
    import {VueEditor} from "vue2-editor";
    import ValidationErrors from "../../../shared/ValidationErrors";
    import ValidationErrorsHelp from "../../../shared/ValidationErrorsHelp";
    import VueTagsInput from '@johmun/vue-tags-input';

    export default {
        components: {
            AdminLayout,
            VueEditor,
            ValidationErrors,
            ValidationErrorsHelp,
            VueTagsInput
        },
        data() {
            return {
                loading: false,
                errors : null,
                status : null,
                tag : '',
                success : false,
                imagePreview : null,
                categories: {
                    name : '',
                    description : '',
                    content : null,
                    slug : '',
                    parent : 0,
                    tags : [],
                    image : null,
                },
            }
        },
        mounted(){
          this.getCategories();
        },
        methods: {
            selectImage: function(event){
                this.imagePreview = URL.createObjectURL(event.target.files[0]);
                var formData = new FormData();
                formData.append("image", event.target.files[0]);
                formData.append("folderName", 'categories');

                const token = localStorage.getItem('token');
                axios({
                    url : 'upload-image',
                    method : "POST",
                    data: formData,
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.categories.image = response.data.data.id; // Get url from response
                }).catch(error => {
                    console.log(error);
                });

            },
            handleImageAdded: function (file, Editor, cursorLocation, resetUploader) {
                var formData = new FormData();
                formData.append("image", file);
                formData.append("folderName", 'editor');
                var token = localStorage.getItem('token');
                axios({
                    url: "/upload-image",
                    method: "POST",
                    data: formData,
                    headers: {Authorization: `Bearer ${token}`},
                })
                    .then(result => {
                        let url = result.data.data.image_url; // Get url from response
                        Editor.insertEmbed(cursorLocation, "image", url);
                        resetUploader();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            sanitizeTitle: function(title) {
                var slug = "";
                var titleLower = title.toLowerCase();
                slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
                slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
                slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
                slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
                slug = slug.replace(/đ/gi, 'd');
                slug = slug.replace(/\s*$/g, '');
                slug = slug.replace(/\s+/g, '-');
                this.categories.slug = slug;
            },
            updateCategoriesSubmit : function(){
                this.loading = false;
                const token = localStorage.getItem('token');
                axios({
                    url: `/categories/${this.$route.params.id}`,
                    method: "PUT",
                    data: this.categories,
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.loading = true;
                    this.errors = null;
                    this.status = response.status;
                    this.success = true;
                    this.$notify(
                        { group: "success", title: "Başarılı", text: "Kayıt güncellendi." },
                        2000
                    );
                }).catch(error => {
                    if(422 === error.response.status){
                        this.errors = error.response.data.errors;
                    }
                    this.success = false;
                    this.status = error.response.status;
                });
            },
            getCategories : function(){
                this.loading = false;
                const token = localStorage.getItem('token');
                axios({
                    url: `/categories/${this.$route.params.id}`,
                    method: "GET",
                    data: this.categories,
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.loading = true;
                    this.errors = null;
                    this.status = response.status;
                    this.categories = response.data.data;
                    this.imagePreview = response.data.data.image.image_url;
                }).catch(error => {
                    if(422 === error.response.status){
                        this.errors = error.response.data.errors;
                    }
                    this.status = error.response.status;
                });
            }
        },

    }
</script>
