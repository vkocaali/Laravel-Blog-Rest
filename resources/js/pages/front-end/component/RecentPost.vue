<template>
    <div>
        <div class="flex mt-16 mb-2 px-4 lg:px-0 items-center justify-between">
            <h2 class="font-bold text-3xl">En Son Paylaşılanlar</h2>
            <a class="bg-gray-200 hover:bg-red-200 text-gray-800 px-3 py-1 rounded cursor-pointer">
                Tümünü Görüntüle
            </a>
        </div>

        <div class="text-gray-700 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <div v-if="recentPost" v-for="(post,index) in recentPost" :key="post.id" class="p-4 md:w-1/3">
                        <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" :src="post.image.image_url"
                                 :alt="post.title">
                            <div class="p-6">
                                <h2 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1">
                                    {{ post.categories.name }}</h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ post.title }}</h1>
                                <p class="leading-relaxed mb-3">{{ post.description }}</p>
                                <div class="flex items-center flex-wrap ">
                                    <router-link :to="{ name : 'home.article.list' , params : { id : post.slug}}"
                                                 class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">
                                        Devamını Gör
                                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                             stroke-width="2" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5l7 7-7 7"></path>
                                        </svg>
                                    </router-link>
                                    <span
                                        class="text-gray-600 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-300">
                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                     stroke-linejoin="round" viewBox="0 0 24 24">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                  <circle cx="12" cy="12" r="3"></circle>
                </svg>1.2K
              </span>
                                    <span class="text-gray-600 inline-flex items-center leading-none text-sm">
                <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                     stroke-linejoin="round" viewBox="0 0 24 24">
                  <path
                      d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                </svg>6
              </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 rounded-lg overflow-hidden">
                                <div class="lg:h-48 bg-gray-400 md:h-36 w-full object-cover object-center"></div>
                                <div class="p-6">
                                    <h2 class="bg-gray-400 animate-pulse h-4 w-1/4 mb-2"></h2>
                                    <h1 class="w-1/2 mb-4 h-6 animate-pulse bg-gray-500"></h1>
                                    <p class="leading-relaxed mb-3 w-full h-3 animate-pulse bg-gray-400"></p>
                                    <p class="leading-relaxed mb-3 w-2/3 h-3 animate-pulse bg-gray-400"></p>
                                    <p class="leading-relaxed mb-3 w-1/2 h-3 animate-pulse bg-gray-400"></p>
                                    <div class="flex items-center flex-wrap ">
                                        <a class="bg-indigo-300 h-4 animate-pulse mt-2 w-32 inline-flex items-center md:mb-2 lg:mb-0"/>
                                        <span
                                            class="bg-indigo-300 w-16 mt-2 h-4 animate-pulse mr-3 px-2 inline-flex items-center ml-auto leading-none text-sm pr-5 py-1"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            recentPost: {},
        }
    },
    mounted() {
        this.getRecentPost();
    },
    methods: {
        getRecentPost() {
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

