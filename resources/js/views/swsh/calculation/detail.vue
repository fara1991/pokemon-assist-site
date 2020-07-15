<template>
    <div>
        <b-card-group class="m-lg-2 text-center font-weight-bolder">
            <b-card>
                <b-card-text>詳細ステータス</b-card-text>
                <b-card-text>図鑑No.{{this.bookNo}} {{this.name}}</b-card-text>
            </b-card>
        </b-card-group>
        <b-card-group class="m-lg-2 text-center">
            <b-card>H = 体力, A = 攻撃, B =防御, C = 特攻, D = 特防, S = 素早</b-card>
        </b-card-group>
        <b-card-group class="m-lg-2">
            <b-card>
                <b-card class="text-center font-weight-bolder">種族値</b-card>
                <b-card>
                    <b-card-text>H： {{this.statusList[0]}}</b-card-text>
                    <b-card-text>A： {{this.statusList[1]}}</b-card-text>
                    <b-card-text>B： {{this.statusList[2]}}</b-card-text>
                    <b-card-text>C： {{this.statusList[3]}}</b-card-text>
                    <b-card-text>D： {{this.statusList[4]}}</b-card-text>
                    <b-card-text>S： {{this.statusList[5]}}</b-card-text>
                </b-card>
            </b-card>
            <b-card>
                <b-card class="text-center font-weight-bolder">個体値(0 〜 31)</b-card>
                <b-card>
                    <b-card-text>H： 31</b-card-text>
                    <b-card-text>A： 31</b-card-text>
                    <b-card-text>B： 31</b-card-text>
                    <b-card-text>C： 31</b-card-text>
                    <b-card-text>D： 31</b-card-text>
                    <b-card-text>S： 31</b-card-text>
                </b-card>
            </b-card>
            <b-card>
                <b-card class="text-center font-weight-bolder">努力値(0 〜 252, 計510)</b-card>
                <b-card>
                    <b-card-text>H： 0</b-card-text>
                    <b-card-text>A： 0</b-card-text>
                    <b-card-text>B： 0</b-card-text>
                    <b-card-text>C： 0</b-card-text>
                    <b-card-text>D： 0</b-card-text>
                    <b-card-text>S： 0</b-card-text>
                </b-card>
            </b-card>
        </b-card-group>
        <b-link @click="back()">back</b-link>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Detail",
        data() {
            return {
                regionId: 0,
                bookNo: this.$route.query.book_no,
                name: '',
                skillList: [],
                statusList: [],
            }
        },
        methods: {
            loadDetail() {
                axios.get(`/api/book-list/${this.bookNo}`).then(res => {
                    let data = res.data[this.regionId];

                    this.name = data.pokemonName;
                    // this.skillList = JSON.parse(data.skillIdList);
                    this.statusList = JSON.parse(data.baseStats).list;
                });
            },
            back() {
                this.$router.back();
            }
        },
        created() {
            this.loadDetail();
        },
        computed: {}
    }
</script>

<style scoped>

</style>
