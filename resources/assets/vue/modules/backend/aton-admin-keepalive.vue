<template>
        <keep-alive>
            <router-view></router-view>
        </keep-alive>
</template>

<script>
    export default {
        data() {
            return {
                name: 'aton-admin-keepalive',
            }
        },
    }
</script>

<style>
</style>