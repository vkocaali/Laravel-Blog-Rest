<template>
    <admin-layout>
        <div class="mt-8">
            <div class="mt-4">
                <div class="p-6 bg-white rounded-md shadow-md">
                    <a @click="$router.go(-1)" class="text-sm cursor-pointer  bg-indigo-500 hover:bg-indigo-700 float-right text-white font-bold py-2 px-4 rounded-full ">
                        Geri Dön
                    </a>


                    <h2 class="text-lg text-gray-700 font-semibold capitalize">Yazı Düzenleme</h2>


                    <form v-on:submit.prevent="updateArticleSubmit">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="name">Yazı Adı</label>
                                <input v-model="updateArticles.title" @keyup="sanitizeTitle(updateArticles.title)"
                                       class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
                                       name="name" type="text" placeholder="Yazı Adı"
                                       aria-label="Yazı Adı">
                                <validation-errors-help class="my-2 mx-1" :status="this.status" :errors="this.errors" field-value="title"/>
                            </div>

                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="slug">Slug</label>
                                <input v-model="updateArticles.slug"
                                       class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="slug"
                                       name="slug" type="text" placeholder="Slug" aria-label="Slug">
                                <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="slug"/>
                            </div>


                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">


                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="categories_id">Kategori Seçiniz</label>
                                <select v-model="updateArticles.categories_id" id="categories_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Kategori Seçiniz</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">{{category.name}}</option>
                                </select>
                                <validation-errors-help class="my-2 mx-1" :status="this.status" :errors="this.errors" field-value="categories_id"/>
                            </div>

                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="categories_id">Yazar Seçiniz</label>
                                <select v-model="updateArticles.author_id" id="author_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Yazar Seçiniz</option>
                                    <option v-for="author in authors" :key="author.id" :value="author.id">{{author.author_name}}</option>
                                </select>
                                <validation-errors-help class="my-2 mx-1" :status="this.status" :errors="this.errors" field-value="author_id"/>
                            </div>


                        </div>


                        <div class="grid grid-cols-1 sm:grid-cols-1 gap-6 mt-4">

                            <div
                                class="bg-white p-2 rounded mt-1 border-b border-grey cursor-pointer hover:bg-grey-lighter">
                                <label class="block text-sm text-black" for="tag">Yazı Etiketleri</label>
                                <vue-tags-input id="tag"
                                                v-model="tag" :tags="updateArticles.tags"
                                                @tags-changed="newTags => updateArticles.tags = newTags"/>
                                <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="tags"/>
                            </div>

                            <div>
                                <label class="block text-sm text-gray-600" for="editor">Yazı İçeriği</label>
                                <vue-editor id="editor" useCustomImageHandler
                                            @image-added="handleImageAdded"
                                            v-model="updateArticles.content"/>
                                <validation-errors-help class="my-2 mx-1"  :status="this.status" :errors="this.errors" field-value="content"/>
                            </div>
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
                selectedCat : '',
                selectedAut : '',
                loading: false,
                errors : null,
                status : null,
                categories : {},
                authors : {},
                tag : '',
                updateArticles: {
                    title : '',
                    content : null,
                    categories_id : '',
                    author_id : '',
                    slug : '',
                    tags : [],
                },
            }
        },
        mounted() {
            this.categoriesGet();
            this.authorsGet();
            this.articlesGet();
        },
        methods: {
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
                this.updateArticles.slug = slug;
            },
            updateArticleSubmit : function(){
                this.loading = false;
                const token = localStorage.getItem('token');
                axios({
                    url: `/articles/${this.$route.params.id}`,
                    method: "PUT",
                    data: this.updateArticles,
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.loading = true;
                    this.errors = null;
                    this.status = response.status;
                    this.$notify(
                        { group: "success", title: "Başarılı", text: "Kayıt güncellendi." },
                        2000
                    );
                }).catch(error => {
                    if(422 === error.response.status){
                        this.errors = error.response.data.errors;
                    }
                    this.status = error.response.status;
                });
            },
            categoriesGet(){
                this.loading = false;
                var token = localStorage.getItem('token');
                axios.get(`/categories?paginate=off`, {headers: {Authorization: `Bearer ${token}`}}).then(response => {
                    this.loading = true;
                    this.categories = response.data.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            authorsGet(){
                this.loading = false;
                var token = localStorage.getItem('token');
                axios.get(`/authors?paginate=off`, {headers: {Authorization: `Bearer ${token}`}}).then(response => {
                    this.loading = true;
                    this.authors = response.data.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            articlesGet(){
                this.loading = false;
                const token = localStorage.getItem('token');
                axios({
                    url: `/articles/${this.$route.params.id}`,
                    method: "GET",
                    data: this.updateArticles,
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.loading = true;
                    this.errors = null;
                    this.status = response.status;
                    this.updateArticles = response.data.data;
                    this.updateArticles.categories_id = response.data.data.categories.id;
                    this.updateArticles.author_id = response.data.data.author.id;
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
