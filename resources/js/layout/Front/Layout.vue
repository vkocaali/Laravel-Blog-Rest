<template>
    <div class="max-w-screen-lg mx-auto">
        <header class="flex items-center  justify-between py-2">
            <navbar/>
        </header>

        <main class="mt-12">
           <slot>
           </slot>
        </main>
        <!-- main ends here -->

        <Footer></Footer>
    </div>

</template>
<script>
    import Navbar from "../Front/Navbar";
    import Footer from '../Front/Footer';

    export default {
        components: {
            Navbar,
            Footer,
        }
    }
</script>
