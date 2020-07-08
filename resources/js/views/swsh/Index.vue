<template>
    <div>
        <b-button block size="lg" variant="secondary" @click="goCalc()">ステータス計算</b-button>
        <b-button block size="lg" variant="secondary" @click="goRanking()">各種ステータスランキング(作成中)</b-button>
        <b-button block size="lg" variant="secondary" @click="goDemo()">戦闘デモ(作成中)</b-button>
        <b-button block size="lg" variant="secondary" @click="goRegister()">PT登録(作成中)</b-button>

        <b-card-group class="m-lg-2">
            <b-card title="各種ステータスランキング(作成中)" sub-title="Ranking Status"></b-card>
        </b-card-group>
        <b-card-group class="m-lg-2">
            <b-card title="戦闘デモ(作成中)" sub-title="Battle Demo"></b-card>
        </b-card-group>
        <b-card-group class="m-lg-2">
            <b-card title="PT登録(作成中)" sub-title="Regist Parties">
            </b-card>
        </b-card-group>
    </div>
</template>

<script>
    export default {
        name: 'swshIndex',
        methods: {
            goCalc() {
                this.$router.push("calculation");
            },
            goRanking() {
                this.$router.push("ranking");
            },
            goDemo() {
                this.$router.push("demo");
            },
            goRegister() {
                this.$router.push("register");
            },
        }
    }
</script>
