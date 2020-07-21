<template>
    <div class="app-body">
        <b-card-header class="text-center">
            <b-link href="/">ポケモン バトルデータ</b-link>
        </b-card-header>
        <div class="container-fluid">
            <b-card-body>
                <Breadcrumbs></Breadcrumbs>
                <perfect-scrollbar>
                    <p>
                        <router-view></router-view>
                    </p>
                </perfect-scrollbar>
            </b-card-body>
        </div>
        <b-card-footer class="text-center">
            © 2020 by <b-link href="https://twitter.com/game_Fara" target="_blank">@Fara</b-link>
        </b-card-footer>
    </div>
</template>

<script>
    export default {
        name: 'Main',
    }
</script>

<style>
    /*#ps {*/
    /*    font-family: 'Avenir', Helvetica, Arial, sans-serif;*/
    /*    -webkit-font-smoothing: antialiased;*/
    /*    -moz-osx-font-smoothing: grayscale;*/
    /*    text-align: center;*/
    /*    color: #2c3e50;*/
    /*    margin-top: 60px;*/
    /*}*/
    .ps{
        position: relative;
        height: 700px;
    }
</style>
