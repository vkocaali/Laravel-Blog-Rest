<template>
   <div>
       <nav class="mt-10">
           <router-link :to="{ name : 'yonetim.anasayfa'}" class="flex items-center mt-4 py-2 px-6 text-gray-400 hover:bg-gray-700 hover:bg-opacity-25">
               <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
               </svg>

               <span class="mx-3">Ana Sayfa</span>
           </router-link>
           <router-link :to="{ name : 'yonetim.ayarlar'}" class="flex items-center mt-4 py-2 px-6 text-gray-400 hover:bg-gray-700 hover:bg-opacity-25">

               <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                   </path>
               </svg>
               <span class="mx-3">Ayarlar</span>
           </router-link>

           <router-link :to="{ name : 'yonetim.kategoriler'}" class="flex items-center mt-4 py-2 px-6 text-gray-400 hover:bg-gray-700 hover:bg-opacity-25">
               <i class="fa fa-list"></i>
               <span class="mx-3">Kategoriler</span>
           </router-link>

           <router-link :to="{ name : 'yonetim.yazilar'}" class="flex items-center mt-4 py-2 px-6 text-gray-400 hover:bg-gray-700 hover:bg-opacity-25">
               <i class="fa fa-edit"></i>
               <span class="mx-3">Yazılar</span>
           </router-link>

       </nav>
   </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        name: 'Sidebar',
        computed: {
            ...mapState(['sideBarOpen'])
        }
    }
</script>
