<template>
    <div>
        Calculation
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "Calculation",
        data() {
           return {
               bookList: [],
           }
        },
        methods: {
            loadBookList() {
                axios.get('/').then(() => {

                }).catch(() => {

                });
            },
        },
    }
</script>

<style scoped>

</style>
