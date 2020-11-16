<template>
    <div v-if="showPagination">
        <ul class="flex pl-0 list-none rounded place-content-center my-2">
            <li v-for="(link, key) in links" :key="key" v-bind:class="isActive(link)" class="border text-sm border-indigo-400 block rounded-sm font-bold py-2 px-3 mr-2 flex hover:indigo-500 hover:text-white" >
                <button @click="fetch(link.label)" v-if="link.url" class="page-link">{{ link.label }}</button >
                <button v-else @click.prevent="handleNoLink" class="page-link">{{link.label}}</button >
            </li>
        </ul>
    </div>


</template>

<script>
    export default {
        props: [
            'links',
            'method',
            'name',
        ],
        methods: {
            isActive(link) {
                return (link.active === true) ? 'bg-indigo-400 text-white' : 'bg-white indigo-500'
            },
            handleNoLink() {
                return false
            },
            fetch(linkLabel){
                this.$router.push({ path: `/yonetim/${this.name}?page=${linkLabel}` });
                this.method();
            }
        },
        computed: {
            showPagination() {
                return this.links.length > 3
            }
        },

    }
</script>
