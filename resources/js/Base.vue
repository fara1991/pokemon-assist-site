<template>
    <div class="app-body">
        <b-card-header class="text-center">ポケモン バトルデータ</b-card-header>
        <div class="container-fluid">
            <b-card-group>
                <b-card-body class="w-25">aaa</b-card-body>
                <b-card-body class="w-75">
                    <nav class="breadcrumb active"></nav>
                    <router-view></router-view>
                </b-card-body>
            </b-card-group>
        </div>
        <b-card-footer class="text-center">
            © 2020 by <a href="https://twitter.com/game_Fara" target="_blank">@Fara</a>
        </b-card-footer>
    </div>
</template>

<script>
    import index from './router'

    export default {
        name: 'base',
        components: {},
        data() {
            return {
                index: index.routes
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
