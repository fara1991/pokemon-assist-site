<template>
    <div class="app">
        <AppHeader/>
        <div class="app-body">
            <Sidebar :navItems="nav"/>
            <main class="main">
                <breadcrumb :list="list"/>
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
    import index from './router'
    // import {} from './components/'

    export default {
        name: 'full',
        components: {

        },
        data() {
            return {
                index: index.routes
            }
        },
        computed: {
            name () {
                return this.$route.name
            },
            list () {
                return this.$route.matched
            }
        }
    }
</script>
