<template>
    <div v-if="errors" class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
        <div v-for="(value, key) in errors" :key="key">
            <p v-for="error in value" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'errors'
        ],
    }
</script>
