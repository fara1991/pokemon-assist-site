<template>
    <div>
        <b-button block size="lg" variant="secondary" @click="goCalc()">ステータス計算</b-button>
        <b-button block size="lg" variant="secondary" @click="goRanking()">各種ステータスランキング(作成中)</b-button>
        <b-button block size="lg" variant="secondary" @click="goDemo()">戦闘デモ(作成中)</b-button>
        <b-button block size="lg" variant="secondary" @click="goRegister()">PT登録(作成中)</b-button>
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
