<template>
    <div v-if="this.finishLoad">
        <b-list-group>
            <b-link @click="back()">aaa</b-link>
        </b-list-group>
        <b-container fluid="">
            <b-input v-model="keyword" placeholder="図鑑IDかポケモン名で検索"></b-input>
            <b-row v-for="bookRow in this.filteredList" :key="bookRow.id">
                <b-col v-for="book in bookRow" :key="book.filterId">
                    <b-link v-if="book.id !== undefined" @click="go(book.bookNo)">No.{{book.bookNo}} {{book.pokemonName}}</b-link>
                    <template v-else></template>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Calculation",
        data() {
            return {
                keyword: '',
                bookList: [],
                finishLoad: false,
                maxRow: 5,
                invalidId: -1,
            }
        },
        methods: {
            loadBookList() {
                if (localStorage.hasOwnProperty('book_list')) {
                    this.bookList = JSON.parse(localStorage.getItem('book_list'));
                } else {
                    axios.get('/api/book-list?versionId=8&bookId=1').then(res => {
                        this.bookList = res.data;
                        localStorage.setItem('book_list', JSON.stringify(res.data));
                    });
                }
                this.finishLoad = true;
            },
            go(bookNo) {
                this.$router.push({name: 'calculationDetail', query: {book_no: bookNo}});
            },
            back() {
                this.$router.back();
            },
        },
        created() {
            this.loadBookList();
        },
        computed: {
            // 算出プロパティ
            filteredList() {
                let filteredList = [];
                let row = [];
                let filterId = 0;

                this.bookList.forEach(book => {
                    let properties = ['bookNo', 'pokemonName'];
                    for (let i of properties) {
                        let propertyName = properties[i];
                        // 部分一致のものだけ検索結果に追加
                        if (String(book[propertyName]).indexOf(this.keyword) === this.invalidId) {
                            continue;
                        }
                        // filter後の連番を割り振り
                        book['filterId'] = filterId;
                        filterId++;
                        row.push(book);
                        break;
                    }

                    if (row.length === this.maxRow) {
                        filteredList.push(row);
                        row = [];
                    }
                });

                // 1行内のカラム数が足りなければ追加
                if (row.length !== 0) {
                    while(row.length !== this.maxRow) {
                        let book = [];
                        book['filterId'] = filterId;
                        filterId++;
                        row.push(book);
                    }
                    filteredList.push(row);
                }
                console.log(filteredList);
                return filteredList;
            }
        }
    }
</script>

<style scoped>

</style>
