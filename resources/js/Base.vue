<template>
    <div class="app-body">
        <b-card-header class="text-center">ポケモン バトルデータ</b-card-header>
        <div class="container-fluid">
            <b-card-body class="m-lg-2">
                <router-view></router-view>
            </b-card-body>
        </div>
        <b-card-footer class="text-center">
            © 2020 by <a href="https://twitter.com/game_Fara" target="_blank">@Fara</a>
        </b-card-footer>
    </div>
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
