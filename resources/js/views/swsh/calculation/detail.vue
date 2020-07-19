<template>
    <div v-if="!isBookLoad || !isPersonalLoad" class="text-center">
        <b-spinner></b-spinner>
    </div>
    <div v-else>
        <b-card-group class="m-lg-1 text-center font-weight-bolder">
            <b-card>
                <b-card-text>図鑑No.{{bookNo}} {{pokemonName}}</b-card-text>
                <b-container>
                    <b-row>
                        <b-col v-if="dataList.length !== 1" v-for="d in dataList" :key="d.regionId">
                            <b-button size="sm" variant="primary" @click="regionChange(d.regionId)">
                                {{d.region}}
                            </b-button>
                        </b-col>
                    </b-row>
                </b-container>
            </b-card>
        </b-card-group>
        <b-card-group class="m-lg-1 text-center">
            <b-card>H = 体力, A = 攻撃, B =防御, C = 特攻, D = 特防, S = 素早</b-card>
        </b-card-group>
        <b-card-group class="m-lg-1">
            <b-card>
                <b-card-text class="text-center font-weight-bolder">種族値(赤:0〜49, 黄:50〜99, 緑:100〜)</b-card-text>
                <div size="sm" v-for="bv in bvList" :key="bv.id">
                    <b-input-group class="mb-xl-1">
                        <b-form class="mb-xl-2">{{bv.name}} {{bv.value}}</b-form>
                    </b-input-group>
                    <b-progress class="mb-lg-2" :value="bv.value" :max="255" :variant="bv.color" show-value animated></b-progress>
                </div>
            </b-card>
            <b-card>
                <b-card-text class="text-center font-weight-bolder">個体値(0 〜 31)</b-card-text>
                <div size="sm" v-for="iv in ivList" :key="iv.id" @input="iv.value=validateNumber(iv.value, typeIv)" onkeydown="return !['.', 'e', 'E', '-', '+'].includes(event.key)">
                    <b-input-group>
                        <b-form class="m-lg-1">{{iv.name}}</b-form>
                        <b-form-input size="sm" class="col-3" type="number" v-model.number="iv.value" min="0" max="31" step="1"></b-form-input>
                        <div >{{ivStatusName(iv.value)}}</div>
                    </b-input-group>
                    <b-form-input size="sm" v-model.number="iv.value" type="range" :max="31" animated></b-form-input>
                </div>
            </b-card>
            <b-card>
                <b-card-text class="text-center font-weight-bolder">努力値(0 〜 252, 計510)</b-card-text>
                <div size="sm" v-for="ev in evList" :key="ev.id" @input="ev.value=validateNumber(ev.value, typeEv)" onkeydown="return !['.', 'e', 'E', '-', '+'].includes(event.key)">
                    <b-input-group>
                        <b-form class="m-lg-1">{{ev.name}}</b-form>
                        <b-form-input size="sm" class="col-3" type="number" v-model.number="ev.value" min="0" max="252" step="4"></b-form-input>
                    </b-input-group>
                    <b-form-input size="sm" v-model.number="ev.value" type="range" max="252" step="4"></b-form-input>
                </div>
            </b-card>
            <b-card>
                <b-card-text class="text-center font-weight-bolder">レベル</b-card-text>
                <b-input-group @input="level=validateNumber(level, typeLevel)" onkeydown="return !['.', 'e', 'E', '-', '+'].includes(event.key)">
                    <b-form class="m-lg-1">Lv:</b-form>
                    <b-form-input size="sm" class="col-3" type="number" v-model.number="level" min="1" max="100" step="1"></b-form-input>
                    <b-button size="sm" @click="level=50">50</b-button>
                    <b-button size="sm" @click="level=100">100</b-button>
                </b-input-group>
                <b-form-input size="sm" v-model.number="level" type="range" min="1" max="100"></b-form-input>

                <b-card-text class="text-center font-weight-bolder mt-4">性格(↑: 1.1倍, ↓: 0.9倍)</b-card-text>
                <b-form-select v-model="personalId">
                    <b-form-select-option v-for="personal in personalityList" :key="personal.id" :value="personal.id">{{personal.text}}</b-form-select-option>
                </b-form-select>
                <b-card-text class="mt-3" v-if="personalityList.length !== 0">性格: {{selectedPersonal().text}}</b-card-text>
            </b-card>
        </b-card-group>
        <b-card-group class="m-lg-1">
            <b-card>
                <b-card-text class="text-center font-weight-bolder">結果</b-card-text>
                <b-card-text class="text-center font-weight-bolder">{{resultStatus}}</b-card-text>
            </b-card>
        </b-card-group>
        <div class="text-center">
            <b-link @click="back()">back</b-link>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Detail",
        data() {
            return {
                isBookLoad: false,
                isPersonalLoad: false,
                dataList: [],
                bookNo: this.$route.query.book_no,
                pokemonName: '',
                bookName: '',
                skillList: [],
                typeIv: 'iv',
                typeEv: 'ev',
                typeLevel: 'level',
                bvList: [],
                ivList: [
                    {name: 'H: ', value: 31},
                    {name: 'A: ', value: 31},
                    {name: 'B: ', value: 31},
                    {name: 'C: ', value: 31},
                    {name: 'D: ', value: 31},
                    {name: 'S: ', value: 31},
                ],
                evList: [
                    {name: 'H: ', value: 0},
                    {name: 'A: ', value: 0},
                    {name: 'B: ', value: 0},
                    {name: 'C: ', value: 0},
                    {name: 'D: ', value: 0},
                    {name: 'S: ', value: 0},
                ],
                level: 50,
                personalityList: [],
                personalId: 1,
            }
        },
        methods: {
            async loadPokemonDetail() {
                // 取得するまで待機
                await axios.get(`/api/book-list/${this.bookNo}`).then(res => {
                    this.dataList = res.data;
                    for (let i = 0; i < this.dataList.length; ++i) {
                        this.dataList[i]['regionId'] = i;
                    }

                    this.regionChange();
                    this.isBookLoad = true;
                });
            },
            async loadPersonality() {
                let list = [];
                if (localStorage.hasOwnProperty('personality_list')) {
                    list = JSON.parse(localStorage.getItem('personality_list'));
                } else {
                    // 取得するまで待機
                    await axios.get('/api/personality-list').then(res => {
                        list = res.data;
                        localStorage.setItem('personality_list', JSON.stringify(res.data));
                    });
                }

                list.forEach(p => {
                    let text = `${p.name}(${p.description})`;
                    this.personalityList.push({
                        id: p.personalId,
                        text: text,
                        value: JSON.parse(p.statusMagnifications),
                    });
                });
                this.isPersonalLoad = true;
            },
            regionChange(regionId = 0) {
                this.pokemonName = this.dataList[regionId].pokemonRegionName;
                this.bookName = this.dataList[regionId].bookName;
                // this.skillList = JSON.parse(data.skillIdList);
                let list = JSON.parse(this.dataList[regionId].baseStats).list;

                let colorList = [];
                for (let i = 0; i < list.length; ++i) {
                    let color = 'success';
                    if (list[i] < 50) {
                        color = 'danger';
                    } else if (list[i] < 100) {
                        color = 'warning';
                    }
                    colorList[i] = color;
                }
                this.bvList = [
                    {name: 'H: ', value: list[0], color: colorList[0]},
                    {name: 'A: ', value: list[1], color: colorList[1]},
                    {name: 'B: ', value: list[2], color: colorList[2]},
                    {name: 'C: ', value: list[3], color: colorList[3]},
                    {name: 'D: ', value: list[4], color: colorList[4]},
                    {name: 'S: ', value: list[5], color: colorList[5]},
                ];
            },
            validateNumber(value, type) {
                let minValue = 0;
                let maxValue = 0;
                if (type === this.typeIv) {
                    minValue = 0;
                    maxValue = 31;
                } else if (type === this.typeEv) {
                    minValue = 0;
                    maxValue = 252;
                } else if (type === this.typeLevel) {
                    minValue = 1;
                    maxValue = 100;
                } else {
                    alert('Warning: 存在しないType');
                }

                if (value < minValue) {
                    value = minValue;
                } else if (value > maxValue) {
                    value = maxValue;
                }
                return value;
            },

            back() {
                this.$router.back();
            },
            selectedPersonal() {
                return this.personalityList[this.personalId - 1];
            },
            ivStatusName(value) {
                if (value === 0) {
                    return 'ダメかも';
                } else if (1 <= value && value <= 15) {
                    return 'まあまあ';
                } else if (16 <= value && value <= 25) {
                    return 'かなりいい';
                } else if (26 <= value && value <= 29) {
                    return 'すごくいい';
                } else if (value === 30) {
                    return 'すばらしい';
                } else if (value === 31) {
                    return 'さいこう(きたえた!)';
                } else {
                    return 'undefined';
                }
            }
        },
        created() {
            this.loadPokemonDetail();
            this.loadPersonality();
        },
        computed: {

            resultStatus() {
                // hp
                let status = '';
                let nameList = ['H:', 'A:', 'B:', 'C:', 'D:', 'S:'];
                let resultHp = Math.floor((this.bvList[0].value * 2 + this.ivList[0].value + Math.floor(this.evList[0].value / 4)) * this.level / 100) + this.level + 10;
                if (this.pokemonName === 'ヌケニン') {
                    resultHp = 1;
                }
                status += (nameList[0] + resultHp);

                // hp以外
                for (let i = 1; i < this.bvList.length; ++i) {
                    let result = Math.floor((Math.floor((this.bvList[i].value * 2 + this.ivList[i].value + Math.floor(this.evList[i].value / 4)) * this.level / 100) + 5) * this.selectedPersonal().value.list[i]);
                    status += (' - ' + nameList[i] + result);
                }

                return status;
            },
        }
    }
</script>

<style scoped>

</style>
