<template>
    <section class="main">

        <!-- サイドバー -->
        <sidebar-contents :title="title" />

        <!-- メインコンテンツ -->
        <div class="main-contents">

            <!-- ヘッダー -->
            <header-contents :title="title" />

            <!-- コンテンツ -->
            <div class="main-area">

                <table class="table table-striped table-holiday">
                    <thead>
                        <tr>
                            <th scope="col" >状態</th>
                            <th scope="col">氏名</th>
                            <th scope="col">休暇開始日</th>
                            <th scope="col">休暇終了日</th>
                            <th scope="col">休暇種別</th>
                            <th scope="col">休暇理由</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(holiday, index) in holidayData" :key="index" v-on:click="selectItem(holiday.id)">
                            <td>
                                <button v-if="holiday.status_no == 1" class="btn status_btn status_btn_draft px-3 mr-3">下書き</button>
                                <button v-if="holiday.status_no == 2" class="btn status_btn status_btn_add px-3 mr-3">申請中</button>
                                <button v-if="holiday.status_no == 3" class="btn status_btn status_btn_back px-3 mr-3">差し戻し</button>
                            </td>
                            <td>{{holiday.staff_name}}</td>
                            <td>{{ formatDate(new Date(holiday.paid_start)) }}</td>
                            <td>{{ formatDate(new Date(holiday.paid_end)) }}</td>
                            <td>
                                {{ holiday.holiday_type == 1 ? "有給":  "欠勤"}}
                            </td>
                            <td>{{holiday.memo}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">　</div>
  
        </div>

        <!-- 確認モーダル -->
        <confirm-modal-dialog modal-id="confirmationModal" @negative-button-click="negativeButtonClick()" @positive-button-click="positiveButtonClick()">
            <template slot="title">
                ○○確認
            </template>
            <template slot="message">
                ○○を更新します。<br />
                よろしいですか？
            </template>
            <template slot="negative-button-content">
                キャンセル
            </template>
            <template slot="positive-button-content">
                OK
            </template>
        </confirm-modal-dialog>

        <!-- 情報モーダル -->
        <information-message-modal-dialog modal-id="informationModal" @close-button-click="closeModal()">
            <template slot="title">
                情報モーダル
            </template>
            <template slot="message">
                ○○を更新しました
            </template>
        </information-message-modal-dialog>

        <!-- バリデーションエラー -->
        <validation-error-message-modal-dialog modal-id="validationErrorModal" :errors="validationErrors" @close-button-click="closeModal()">
            <template slot="title">
                入力内容に誤りがあります
            </template>
        </validation-error-message-modal-dialog>

        <!-- 検索中モーダル -->
        <loading-modal-dialog modal-id="loadingModal"></loading-modal-dialog>

    </section>
</template>

<script>
import HeaderContents from '../common/components/HeaderContents.vue'
import SidebarContents from '../common/components/SidebarContents.vue'
import ConfirmModalDialog from '../common/components/ConfirmModalDialog.vue'
import InformationMessageModalDialog from '../common/components/InformationMessageModalDialog.vue'
import ValidationErrorMessageModalDialog from '../common/components/ValidationErrorMessageModalDialog.vue'
import LoadingModalDialog from '../common/components/LoadingModalDialog.vue'

export default {
    // 継承する変数
    props: {
        // タイトル
        title: {
            type: String,
            default: "",
        },
        // 休暇申請データ
        holidayData: {
            type: Array,
            default: () => [],
        },

    },
    // 外部コンポーネント
    components: {
        HeaderContents,
        SidebarContents,
        ConfirmModalDialog,
        InformationMessageModalDialog,
        ValidationErrorMessageModalDialog,
        LoadingModalDialog,
    },
    // ローカルモデル
    data() {
        return {
            validationErrors: [],
        }
    },
    // TODO モデル監視用
    watch: {
        
    },
    // 初回実行
    mounted: function () {

    },
    // 関数
    methods: {
        selectItem: function(val) {
            console.log('/holiday/form?id='+val);
            window.location.href = '/holiday/update/' + val;
            this.updateFlag = true;
        },

        // 日付をYYYY-MM-DDの書式で返すメソッド
        formatDate: function(dt) {
            var y = dt.getFullYear();
            var m = ('00' + (dt.getMonth()+1)).slice(-2);
            var d = ('00' + dt.getDate()).slice(-2);
            return (y + '-' + m + '-' + d);
        },

        openConfirmationModal: function() {
            $('#confirmationModal').modal('show');
        },
        openInformationModal: function() {
            $('#informationModal').modal('show');
        },
        openValidationErrorModal: function() {
            $('#validationErrorModal').modal('show');
        },
        openLoadingModal: function() {
            $('#loadingModal').modal('show');
        },
        closeModal: function() {
            console.log('モーダル閉じる！')
        },
        negativeButtonClick: function() {
            console.log('キャンセルだよおお')
        },
        positiveButtonClick: function() {
            console.log('OKだよおおお')
        },
        getHoliday: function() {
            let vm = this;
            axios
                .get('/api/getHoliday')
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    if(error.response.data.errors != null){
                        vm.validationErrors = error.response.data.errors;
                        $('#validationErrorModal').modal('show');
                    }else{
                        $('#systemErrorModal').modal('show');
                    }
                });
        },
        postHoliday: function() {
            let vm = this;
            let postData = {
                'postMessage': 'vue から送信したメッセージ',
            }
            axios
                .post('/api/postHoliday', postData)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    if(error.response.data.errors != null){
                        vm.validationErrors = error.response.data.errors;
                        $('#validationErrorModal').modal('show');
                    }else{
                        $('#systemErrorModal').modal('show');
                    }
                });
        },
    },
    // 共通vueファイル読み込み
    mixins: [
        Vue.extend(require('../common/mixin/PageTransition.vue')),
        Vue.extend(require('../common/mixin/Common.vue')),
    ]
}
</script>
