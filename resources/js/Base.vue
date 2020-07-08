<template>
    <router-view></router-view>
</template>

<script>
    import index from './router/index';

    export default {
        name: 'base',
        data() {
            return {
                index: index,
            }
        },
        computed: {
            name() {
                return this.$route.name
            },
            list() {
                return this.$route.matched
            }
        }
    }
</script>
