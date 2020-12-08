<template>
    <div>
        <div class="flex mt-16 mb-2 px-4 lg:px-0 items-center justify-between">
            <h2 class="font-bold text-3xl">En Son Paylaşılanlar</h2>
            <a class="bg-gray-200 hover:bg-red-200 text-gray-800 px-3 py-1 rounded cursor-pointer">
                Tümünü Görüntüle
            </a>
        </div>
        <div class="block space-x-0 lg:flex lg:space-x-6">

            <section class="blog text-gray-700 body-font">
                <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">

                        <div class="p-4 md:w-1/3 md:mb-0 mb-6 flex flex-col justify-center items-center max-w-sm mx-auto" v-for="(post,index) in recentPost" :key="post.id">
                            <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" :style="`background-image: url(${post.image.image_url})`"></div>

                            <div class=" w-70 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">

                                <div class="header-content inline-flex ">
                                    <div class="category-badge flex-1  h-4 w-4 m rounded-full m-1 bg-green-100">
                                        <div class="h-2 w-2 rounded-full m-1 bg-green-500 " ></div>
                                    </div>
                                    <div class="category-title flex-1 text-sm mt-1"> {{post.categories.name}}</div>
                                </div>
                                <div class="title-post font-extrabold mt-2"><strong>{{post.title}}</strong></div>

                                <div class="summary-post text-base text-justify mt-3">{{post.description}}

                                    <div class="m-2 text-center">
                                        <router-link :to="{ name : 'home.article.list' , params : { id : post.slug}}" class="text-center bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                            <span class="mr-2">İncele</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                            </svg>
                                        </router-link>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>





        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                recentPost : {},
            }
        },
        mounted() {
            this.getRecentPost();
        },
        methods : {
          getRecentPost(){
              this.loading = false;
              axios.get(`/recent-post`).then(response => {
                  this.loading = true;
                  console.log(response.data.data);
                  this.recentPost = response.data.data;
              }).catch(err => console.log(err));
          }

        },
    }
</script>

