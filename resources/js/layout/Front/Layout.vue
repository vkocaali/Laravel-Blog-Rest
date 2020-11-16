<template>
    <div class="max-w-screen-lg mx-auto">
        <header class="flex items-center justify-between py-2">
            <navbar/>
        </header>

        <main class="mt-12">

            <FeaturedPost/>
            <RecentPost/>
            <Subscribe/>

            <!-- popular posts -->
            <div class="flex mt-16 mb-4 px-4 lg:px-0 items-center justify-between">
                <h2 class="font-bold text-3xl">Popular news</h2>
                <a class="bg-gray-200 hover:bg-green-200 text-gray-800 px-3 py-1 rounded cursor-pointer">
                    View all
                </a>
            </div>
            <div class="block space-x-0 lg:flex lg:space-x-6">

                <div class="rounded w-full lg:w-1/2 lg:w-1/3 p-4 lg:p-0">
                    <img src="https://images.unsplash.com/photo-1526666923127-b2970f64b422?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=900&q=60" class="rounded" alt="technology" />
                    <div class="p-4 pl-0">
                        <h2 class="font-bold text-2xl text-gray-800">Put all speaking her delicate recurred possible.</h2>
                        <p class="text-gray-700 mt-2">
                            Set indulgence inquietude discretion insensible bed why announcing. Middleton fat two satisfied additions.
                            So continued he or commanded household smallness delivered. Door poor on do walk in half. Roof his head the what.
                        </p>

                        <a href="#" class="inline-block py-2 rounded text-green-900 mt-2 ml-auto"> Read more </a>
                    </div>
                </div>

                <div class="rounded w-full lg:w-1/2 lg:w-1/3 p-4 lg:p-0">
                    <img src="https://images.unsplash.com/photo-1504384764586-bb4cdc1707b0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=900&q=60" class="rounded" alt="technology" />
                    <div class="p-4 pl-0">
                        <h2 class="font-bold text-2xl text-gray-800">Is at purse tried jokes china ready decay an. </h2>
                        <p class="text-gray-700 mt-2">
                            Small its shy way had woody downs power. To denoting admitted speaking learning my exercise so in.
                            Procured shutters mr it feelings. To or three offer house begin taken am at.
                        </p>

                        <a href="#" class="inline-block py-2 rounded text-green-900 mt-2 ml-auto"> Read more </a>
                    </div>
                </div>

                <div class="rounded w-full lg:w-1/2 lg:w-1/3 p-4 lg:p-0">
                    <img src="https://images.unsplash.com/photo-1483058712412-4245e9b90334?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80" class="rounded" alt="technology" />
                    <div class="p-4 pl-0">
                        <h2 class="font-bold text-2xl text-gray-800">As dissuade cheerful overcame so of friendly he indulged unpacked.</h2>
                        <p class="text-gray-700 mt-2">
                            Alteration connection to so as collecting me.
                            Difficult in delivered extensive at direction allowance.
                            Alteration put use diminution can considered sentiments interested discretion.
                        </p>

                        <a href="#" class="inline-block py-2 rounded text-green-900 mt-2 ml-auto"> Read more </a>
                    </div>
                </div>

            </div>
            <!-- end popular posts -->

        </main>
        <!-- main ends here -->

        <Footer></Footer>
    </div>

</template>
<script>
    import Navbar from "../Front/Navbar";
    import Footer from '../Front/Footer';
    import FeaturedPost from '../../pages/front-end/component/FeaturedPost';
    import RecentPost from '../../pages/front-end/component/RecentPost';
    import Subscribe from '../../pages/front-end/component/Subscribe';

    export default {
        components: {
            Navbar,
            Footer,
            FeaturedPost,
            RecentPost,
            Subscribe
        }
    }
</script>
