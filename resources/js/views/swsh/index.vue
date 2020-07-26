<template>
    <div class="text-center">
        <b-button size="lg" variant="info" @click="goCalc()">ステータス計算</b-button>
        <b-button size="lg" variant="info" @click="goRanking()">ランキング</b-button>
        <b-button size="lg" variant="info" @click="goDemo()" disabled>戦闘デモ(作成中)</b-button>
        <b-button size="lg" variant="info" @click="goRegister()" disabled>PT登録(作成中)</b-button>
    </div>
</template>

<script>
    export default {
        name: 'swshIndex',
        methods: {
            goCalc() {
                this.$router.push({name: "calculationIndex"});
            },
            goRanking() {
                this.$router.push({name: "rankingIndex"});
            },
            goDemo() {
                this.$router.push({name: "demoIndex"});
            },
            goRegister() {
                this.$router.push({name: "registerIndex"});
            },
        }
    }
</script>
