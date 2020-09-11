<template>
    <div v-if="!finishLoad" class="text-center">
        <b-spinner variant="primary"></b-spinner>
    </div>
    <div v-else>
        <b-card-group class="text-center font-weight-bolder">
            <b-card>
                <b-card-text>図鑑No.{{bookNo}} {{pokemonName}}</b-card-text>
                <b-container v-if="regionList.length !== 1">
                    <b-row>
                        <b-col v-for="d in regionList" :key="d.regionId">
                            <b-button size="sm" variant="primary" @click="regionChange(d.regionId)">{{d.region}}</b-button>
                        </b-col>
                    </b-row>
                </b-container>
            </b-card>
        </b-card-group>
        <b-card-group>
            <b-card>
                <b-card-text class="text-center font-weight-bolder">種族値</b-card-text>
                <div size="sm" v-for="bv in bvList" :key="bv.id">
                    <b-input-group class="mb-xl-1">
                        <b-form class="mb-xl-2">{{bv.name}} {{bv.value}}</b-form>
                    </b-input-group>
                    <b-progress class="mb-lg-2" :value="bv.value" :max="maxBvValue" :variant="bv.color" show-value animated></b-progress>
                </div>
            </b-card>
            <b-card>
                <b-card-text class="text-center font-weight-bolder">個体値(0 〜 31)</b-card-text>
                <div size="sm" v-for="iv in ivList" :key="iv.id" @input="iv.value=book.validateNumber(iv.value, book.typeIv)" onkeydown="return !['.', 'e', 'E', '-', '+'].includes(event.key)">
                    <b-input-group>
                        <b-form class="m-lg-1">{{iv.name}}</b-form>
                        <b-form-input size="sm" class="col-3" type="number" v-model.number="iv.value" min="0" max="31" step="1"></b-form-input>
                        <div >{{book.ivStatusName(iv.value)}}</div>
                    </b-input-group>
                    <b-form-input size="sm" v-model.number="iv.value" type="range" :max="31" animated></b-form-input>
                </div>
            </b-card>
            <b-card>
                <b-card-text class="text-center font-weight-bolder">
                    努力値(0 〜 252) 計
                    <span v-if="this.calcTotalEvValue > 510" class="text-danger">{{this.calcTotalEvValue}}</span>
                    <span v-else>{{this.calcTotalEvValue}}</span>
                    / 510
                </b-card-text>
                <div size="sm" v-for="ev in evList" :key="ev.id" @input="ev.value=book.validateNumber(ev.value, book.typeEv)" onkeydown="return !['.', 'e', 'E', '-', '+'].includes(event.key)">
                    <b-input-group>
                        <b-form class="m-lg-1">{{ev.name}}</b-form>
                        <b-form-input size="sm" class="col-3" type="number" v-model.number="ev.value" min="0" max="252" step="4"></b-form-input>
                    </b-input-group>
                    <b-form-input size="sm" v-model.number="ev.value" type="range" max="252" step="4"></b-form-input>
                </div>
            </b-card>
            <b-card>
                <b-card-text class="text-center font-weight-bolder">レベル</b-card-text>
                <b-input-group @input="level=book.validateNumber(level, book.typeLevel)" onkeydown="return !['.', 'e', 'E', '-', '+'].includes(event.key)">
                    <b-form class="m-lg-1">Lv:</b-form>
                    <b-form-input size="sm" class="col-3" type="number" v-model.number="level" min="1" max="100" step="1"></b-form-input>
                    <b-button size="sm" @click="level=50">50</b-button>
                    <b-button size="sm" @click="level=100">100</b-button>
                </b-input-group>
                <b-form-input size="sm" v-model.number="level" type="range" min="1" max="100"></b-form-input>

                <b-card-text class="text-center font-weight-bolder mt-4">性格(↑: 1.1倍, ↓: 0.9倍)</b-card-text>
                <b-form-select v-model="personalId">
                    <b-form-select-option v-for="p in personalList" :key="p.id" :value="p.id">{{p.text}}</b-form-select-option>
                </b-form-select>
                <b-card-text class="mt-3" v-if="personalList.length !== 0">性格: {{selectedPersonal().text}}</b-card-text>
            </b-card>
        </b-card-group>
        <b-card-group>
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
    import constBook from '../../../const/book';

    export default {
        name: "Detail",
        data() {
            return {
                book: constBook,
                finishLoad: false,
                regionList: [],
                bookNo: this.$route.query.book_no,
                regionId: this.$route.query.region_id,
                pokemonName: '',
                bookName: '',
                skillList: [],
                maxBvValue: 255,
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
                personalList: [],
                personalId: 1,
            }
        },
        methods: {
            loadPokemonDetail() {
                axios.get(`/api/book-list/${this.bookNo}`).then(res => {
                    this.regionList = res.data;
                    this.regionChange(this.regionId);
                    this.finishLoad = true;
                });
            },
            loadPersonal() {
                if (localStorage.hasOwnProperty('personality_list')) {
                    this.personalList = JSON.parse(localStorage.getItem('personality_list'));
                } else {
                    let list = [];
                    axios.get('/api/personality-list').then(res => {
                        list = res.data;
                        console.log(list);
                        let l = [];
                        list.forEach(p => {
                            let text = `${p.name}(${p.description})`;
                            l.push({
                                id: p.personalId,
                                text: text,
                                value: JSON.parse(p.statusMagnifications),
                            });
                        });
                        this.personalList = l;
                        localStorage.setItem('personality_list', JSON.stringify(l));
                    });
                }
            },
            regionChange(regionId = 0) {
                this.pokemonName = this.regionList[regionId - 1].pokemonRegionName;
                this.bookName = this.regionList[regionId - 1].bookName;
                // this.skillList = JSON.parse(data.skillIdList);
                let list = JSON.parse(this.regionList[regionId - 1].baseStats).list;
                this.maxBvValue = Math.max(...list);

                // max値の50%以下なら黄、25%以下なら赤
                let colorList = [];
                for (let i = 0; i < list.length; ++i) {
                    let color = 'success';
                    if (list[i] <= Math.ceil(this.maxBvValue / 4)) {
                        color = 'danger';
                    } else if (list[i] <= Math.ceil(this.maxBvValue / 2)) {
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
            back() {
                this.$router.back();
            },
            selectedPersonal() {
                return this.personalList[this.personalId - 1];
            },
            initialize() {
                this.loadPokemonDetail();
                this.loadPersonal();
            }
        },
        created() {
            this.initialize();
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
            calcTotalEvValue() {
                let value = 0;
                this.evList.forEach(p => {
                    value += p.value;
                });

                return value;
            },
        }
    }
</script>

<style scoped>

</style>
