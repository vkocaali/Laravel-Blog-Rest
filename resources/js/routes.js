import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from "./pages/front-end/Home";
import Dashboard from "./pages/admin/Dashboard";
import Login from "./pages/auth/Login";
import Settings from './pages/admin/Settings/Index';
import Categories from './pages/admin/Categories/Index';
import CategoriesCreate from './pages/admin/Categories/Create';
import CategoriesUpdate from "./pages/admin/Categories/Update";
import Articles from "./pages/admin/Articles/Index";
import ArticlesCreate from "./pages/admin/Articles/Create";
import ArticlesUpdate from "./pages/admin/Articles/Update";

import store from './store';


Vue.use(VueRouter);

const routes = [
    {
        path : '/' ,
        component: Home ,
        name : 'home',
        meta : {
            title : 'Volkan Kocaali Blog'
        }
    },
    {
        path : '/giris-yap' ,
        component: Login ,
        name : 'login',
        meta : {
            title : 'Giriş Yap - VK Blog'
        }
    },
    {
        path : '/yonetim' ,
        component: Dashboard,
        name : 'yonetim.anasayfa',
        meta: {
            title : 'Ana Sayfa - Yönetim Paneli',
            requiresAuth: true
        }
    },
    {
        path : '/yonetim/ayarlar' ,
        component: Settings,
        name : 'yonetim.ayarlar',
        meta: {
            title : 'Ayarlar - Yönetim Paneli',
            requiresAuth: true
        }
    },
    {
        path : '/yonetim/kategoriler' ,
        component: Categories,
        name : 'yonetim.kategoriler',
        meta: {
            title : 'Kategoriler - Yönetim Paneli',
            requiresAuth: true
        }
    },
    {
        path : '/yonetim/kategoriler/create' ,
        component: CategoriesCreate,
        name : 'yonetim.kategoriler.create',
        meta: {
            title : 'Kategori Ekle - Yönetim Paneli',
            requiresAuth: true
        }
    },
    {
        path : '/yonetim/kategoriler/update/:id' ,
        component: CategoriesUpdate,
        name : 'yonetim.kategoriler.update',
        meta: {
            title : 'Kategori Güncelle - Yönetim Paneli',
            requiresAuth: true
        }
    },
    {
        path : '/yonetim/yazilar' ,
        component: Articles,
        name : 'yonetim.yazilar',
        meta: {
            title : 'Yazılar - Yönetim Paneli',
            requiresAuth: true
        }
    },
    {
        path : '/yonetim/yazilar/create' ,
        component: ArticlesCreate,
        name : 'yonetim.yazilar.create',
        meta: {
            title : 'Yazı Ekle - Yönetim Paneli',
            requiresAuth: true
        }
    },
    {
        path : '/yonetim/yazilar/update/:id' ,
        component: ArticlesUpdate,
        name : 'yonetim.yazilar.update',
        meta: {
            title : 'Yazılar Güncelle - Yönetim Paneli',
            requiresAuth: true
        }
    },



];



const router = new VueRouter({
    routes,
    mode : "history",
    linkActiveClass: '',
    linkExactActiveClass: 'bg-indigo-600 text-white',
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    },
});

router.beforeEach((to, from, next) => {
    /* It will change the title when the router is change*/
    if (to.meta.title) {
        document.title = to.meta.title;
    }
    next();
});

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return
        }
        next('/giris-yap');
    } else {
        next();
    }
});


export default router;
