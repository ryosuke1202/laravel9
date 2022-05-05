<template>
    <div>
        <vue-suggest-input
            v-show="isShow"
            v-model="selected"
            placeholder="Text here"
            :items="items"
            class="order-number-input"
            @search="searchOrder()"
        >
        </vue-suggest-input>
    </div>
</template>

<script>
import VueSuggestInput from 'vue-suggest-input';
import 'vue-suggest-input/dist/vue-suggest-input.css'
  export default {
    components: {
      VueSuggestInput,
    },
    props: {
      autocompleteItems: {
        type: Array,
        default: [],
      },
    },
    data() {
      return {
        selected: '',
        items: this.autocompleteItems,
        isShow: false,
      };
    },
    methods: {
        // 非同期で一覧画面に表示させるか、詳細画面を表示させるか迷い中
        searchOrder: function () {
            // セッションクリア
            sessionStorage.clear();
            // セッションに注文番号をセット（一覧画面に戻った際に再度詳細ページに遷移できるようにするため）
            sessionStorage.setItem('orderNum', this.selected);
            sessionStorage.setItem('backFlg', 1);
            window.location.href = 'http://localhost/carts/' + this.selected;
        },
    },
    computed: {
      filteredItems() {
        return this.autocompleteItems.filter(i => {
          return i.toLowerCase().indexOf(this.selected.toLowerCase()) !== -1;
        });
      },
    },
    mounted() {
      window.onload = ()=>{
        if (!this.items.length == 0) {
          this.isShow = true
        }
      }
    },
  };
</script>

<style lang="css" scoped>
  .carts-order-number-input {
    max-width: inherit;
  }
</style>
<style lang="css">
  .carts-order-number-input .ti-tag {
    background: transparent;
    border: 1px solid #747373;
    color: #747373;
    margin-right: 4px;
    border-radius: 0px;
    font-size: 13px;
    width: 500vw;
  }

  .order-number-input {
      width: 30vw;
  }
</style>
