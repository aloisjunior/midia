<template>
    <transition name="slide-fade" mode="out-in">
    <router-view></router-view>
    </transition>
</template>

<script>
    export default {
        name: 'aton-admin-sem-keepalive',
        data() {
            return {

            }
        },
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
        opacity: 0
    }

    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active for <2.1.8 */ {
        transform: translateX(7px);
        opacity: 0;
    }
</style>