<template>
    <div v-if="!this.finishLoad" class="text-center">
        <b-spinner variant="primary"></b-spinner>
    </div>
    <div v-else>
        <b-input v-model="keyword" placeholder="図鑑IDかポケモン名で検索" class="mb-4"></b-input>
        <perfect-scrollbar>
            <p>
                <b-table :fields="tableHeader" :items="filteredList" :sort-by.sync="sort" striped small>
                    <template v-slot:cell(なまえ)="data">
                        <b-link @click="go(data.value.linkNo, data.value.regionId)">{{data.value.name}}</b-link>
                    </template>
                </b-table>
            </p>
        </perfect-scrollbar>
    </div>
</template>

<script>
    import axios from 'axios';
    import constString from '../../../const/string';

    export default {
        name: "Calculation",
        data() {
            return {
                keyword: '',
                bookList: [],
                finishLoad: false,
                maxRow: 5,
                invalidId: -1,
                sort: 'No',
                tableHeader: [
                    {key: 'No', sortable: true},
                    {key: 'なまえ', sortable: true},
                    {key: 'たいりょく', sortable: true},
                    {key: 'こうげき', sortable: true},
                    {key: 'ぼうぎょ', sortable: true},
                    {key: 'とくこう', sortable: true},
                    {key: 'とくぼう', sortable: true},
                    {key: 'すばやさ', sortable: true},
                    {key: 'ごうけい', sortable: true},
                ]
            }
        },
        methods: {
            async loadBookList() {
                let list = [];
                if (localStorage.hasOwnProperty('book_list')) {
                    list = JSON.parse(localStorage.getItem('book_list'));
                } else {
                    await axios.get('/api/book-list?versionId=8&bookId=1').then(res => {
                        list = res.data;
                        localStorage.setItem('book_list', JSON.stringify(res.data));
                    });
                }

                let l = [];
                list.forEach(b => {
                    let items = [];
                    let status = JSON.parse(b.baseStats).list;
                    items['No'] = 'No.' + b.bookNo;
                    items['なまえ'] = {linkNo: b.bookNo, regionId: b.regionId, name: b.pokemonRegionName};
                    items['たいりょく'] = status[0];
                    items['こうげき'] = status[1];
                    items['ぼうぎょ'] = status[2];
                    items['とくこう'] = status[3];
                    items['とくぼう'] = status[4];
                    items['すばやさ'] = status[5];
                    items['ごうけい'] = Number(status[0]) + Number(status[1]) + Number(status[2]) + Number(status[3]) + Number(status[4]) + Number(status[5]);
                    l.push(items);
                });
                this.bookList = l;
                this.finishLoad = true;
            },
            go(bookNo, regionId) {
                this.$router.push({name: 'calculationDetail', query: {book_no: bookNo, region_id: regionId}});
            },
        },
        created() {
            this.loadBookList();
        },
        computed: {
            // 算出プロパティ
            filteredList() {
                let filteredList = [];
                let filterId = 0;

                this.bookList.forEach(book => {
                    for (let propertyName of Object.keys(book)) {
                        // 部分一致のものだけ検索結果に追加
                        if (propertyName === 'なまえ') {
                            let hiragana = constString.katakanaToHiragana(book[propertyName].name);
                            let katakana = constString.hiraganaToKatakana(book[propertyName].name);
                            if (
                                String(hiragana).indexOf(this.keyword) === this.invalidId &&
                                String(katakana).indexOf(this.keyword) === this.invalidId
                            ) {
                                continue;
                            }
                        } else if (String(book[propertyName]).indexOf(this.keyword) === this.invalidId) {
                            continue;
                        }
                        // filter後の連番を割り振り
                        book['filterId'] = filterId;
                        filterId++;
                        filteredList.push(book);
                        break;
                    }
                });
                return filteredList;
            }
        }
    }
</script>

<style scoped>
.ps {
    position: relative;
    max-height: 600px;
}
</style>
