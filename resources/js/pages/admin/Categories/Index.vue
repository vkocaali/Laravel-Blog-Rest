<template>
    <admin-layout>
        <h3 class="text-gray-700 text-3xl font-medium">Kategoriler Listele</h3>

        <div class="mt-8">
            <div class="mt-6">

                <router-link :to="{ name : 'yonetim.kategoriler.create' }" class="text-sm bg-indigo-500 hover:bg-indigo-700 float-right text-white font-bold py-2 px-4 rounded-full">
                   Yeni Kategori Ekle
                </router-link>

                <div class="mt-3 flex flex-col sm:flex-row">
                    <div class="flex">
                        <div class="relative">
                            <select v-model="filtered.selectedPaginate" @change="getCategories" class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option v-for="item in filtered.paginate" :key="item.id" :value="item.id">{{item.text}}</option>
                            </select>

                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative">
                            <select v-model="filtered.selectedStatus" @change="getCategories" class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                <option v-for="item in filtered.status" :key="item.id" :value="item.id">{{item.text}}</option>
                            </select>

                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="block relative mt-2 sm:mt-0">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path>
                        </svg>
                    </span>

                        <input v-model="filtered.search" @keyup="getCategories" placeholder="Arama Yap" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                    </div>
                </div>


                <div v-if="loading" class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">

                        <table v-if="categories.data.length > 0" class="min-w-full leading-normal">
                            <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori Adı</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tarih</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aktif</th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in categories.data" :key="categories.id">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900">{{category.id}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white ">
                                    <p class="text-gray-900 text-sm">{{category.name}}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 text-sm">{{category.created_at | formatDate}}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden :class="category.is_active === 1 ? 'bg-green-200' : 'bg-red-200'" class="absolute inset-0 opacity-50 rounded-full"></span>
                                        <span class="relative">{{ category.is_active === 1 ? 'Aktif' : 'Pasif' }}</span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                                    <router-link :to="{ name : 'yonetim.kategoriler.update',params : {id : category.id } }" class="whitespace-no-wrap bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                        <span><i class="fa fa-edit"></i></span>
                                    </router-link>


                                    <button @click="deleteCategories(category.id)" class="whitespace-no-wrap bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                        <span><i class="fa fa-trash"></i></span>
                                    </button>

                                </td>
                            </tr>

                            </tbody>
                        </table>

                        <div v-else>
                            <div class="bg-red-100 border text-center border-orange-400 text-orange-700 px-4 py-4 rounded relative" role="alert">
                                <strong class="font-bold">Veri Bulunamadı.</strong>
                                <span class="block sm:inline">Aradığınız kriterlere göre bir veri bulunamadı.</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-orange-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Kapat</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                  </span>
                            </div>
                        </div>


                        <div class="place-content-center ">
                            <pagination :links="categories.meta.links" :method="getCategories" name="kategoriler" ></pagination>
                        </div>


                    </div>
                </div>

                <Spinner v-else/>

            </div>
        </div>

    </admin-layout>
</template>

<script>
    import AdminLayout from "../../../layout/AdminLayout";
    import Pagination from '../../../shared/Pagination';
    import Spinner from "../../../components/Spinner";

    export default {
        components : {
            Spinner,
            AdminLayout,
            Pagination,
        },
        data() {
            return {
                loading : false,
                filtered : {
                    selectedPaginate : 5,
                    selectedStatus : 'all',
                    status : [
                        { id : 'all' , 'text' : 'Hepsi'},
                        { id : '1' , 'text' : 'Aktif'},
                        { id : '0' , 'text' : 'Pasif'},
                    ],
                    paginate : [
                        { id : '5' , 'text' : '5'},
                        { id : '10' , 'text' : '10'},
                        { id : '50' , 'text' : '50'},
                    ],
                    search : '',
                },
                categories : {},
            }
        },
        mounted() {
            this.getCategories();
        },
        methods : {
            getCategories(){
                this.loading = false;
                var token = localStorage.getItem('token');
                axios.get(`/categories?status=${this.filtered.selectedStatus}&paginate=${this.filtered.selectedPaginate}&search=${this.filtered.search}&page=${this.$route.query.page}`, {headers: {Authorization: `Bearer ${token}`}}).then(response => {
                    this.loading = true;
                    this.categories = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            deleteCategories(id){
                this.loading = false;
                var token = localStorage.getItem('token');
                axios({
                    url: `/categories/${id}`,
                    method: "DELETE",
                    headers: {Authorization: `Bearer ${token}`},
                }).then(response => {
                    this.loading = true;
                    this.errors = null;
                    this.status = response.status;
                    this.success = true;
                    this.getCategories();
                    this.$notify(
                        { group: "success", title: "Başarılı", text: "Kayıt silindi." },
                        2000
                    );
                })
            },


        },
    }
</script>
