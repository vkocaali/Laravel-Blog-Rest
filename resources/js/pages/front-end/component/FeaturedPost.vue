<template>
    <div>
        <div class="mt-10">
            <div class="block md:flex md:space-x-2 px-2 lg:p-0">
                <router-link
                    :to="{ name : 'home.article.list' , params : { id : item.slug}}"
                    v-for="item in favoritePost" :key="item.id"
                    class="mb-4 md:mb-0 w-full md:w-2/3 relative rounded inline-block"
                    style="height: 24em;"
                >
                    <div class="absolute left-0 bottom-0 w-full h-full z-0"
                         style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
                    <img :src="item.image.image_url" class="absolute left-0 top-0 w-full h-full rounded z-0 object-cover" />
                    <div class="p-4 absolute bottom-0 left-0 z-0">
                        <span class="px-4 py-1 bg-black text-gray-200 inline-flex items-center justify-center mb-2">{{ item.categories.name}}</span>
                        <h2 class="text-4xl font-semibold text-gray-100 leading-tight">
                            {{ item.title }}
                        </h2>
                        <div class="flex mt-3">
                            <img src="https://randomuser.me/api/portraits/men/97.jpg"
                                 class="h-10 w-10 rounded-full mr-2 object-cover" />
                            <div>
                                <p class="font-semibold text-gray-200 text-sm"> {{ item.author.author_name }} </p>
                                <p class="font-semibold text-gray-400 text-xs"> {{ item.publish_date | formatDate}} </p>
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>

    </div>

</template>


<script>

export default {
    data() {
        return {
            favoritePost: {},
        }
    },
    mounted() {
        this.getFavoritePost();
    },
    methods: {
        getFavoritePost() {
            this.loading = false;
            axios.get(`/favorite-post`).then(response => {
                console.log(response.data.data);
                this.loading = true;
                this.favoritePost = response.data.data;
            }).catch(err => console.log(err));
        }
    },
}
</script>
