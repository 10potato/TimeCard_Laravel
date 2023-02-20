<template>
    <section class="main workJournal">

        <!-- ヘッダー -->
        <header-contents :title="title" />

        <!-- メインコンテンツ -->
        <div class="main-contents">

            <!-- コンテンツ -->
            <div class="main-area">
                <div class="row">
                    <div class="col-12">
                        {{ sampleMessage }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <input type="button" class="btn btn-primary" value="確認" @click="openConfirmationModal()">
                    </div>
                    <div class="col-auto">
                        <input type="button" class="btn btn-warning" value="情報" @click="openInformationModal()">
                    </div>
                    <div class="col-auto">
                        <input type="button" class="btn btn-danger" value="バリデーション" @click="openValidationErrorModal()">
                    </div>
                    <div class="col-auto">
                        <input type="button" class="btn btn-success" value="読み込み中" @click="openLoadingModal()">
                    </div>
                    <div class="col-auto">
                        <input type="button" class="btn btn-primary" value="GET Sample" @click="getSample()">
                    </div>
                    <div class="col-auto">
                        <input type="button" class="btn btn-primary" value="POST Sample" @click="postSample()">
                    </div>
                </div>

                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">name</th>
                                <th scope="col">section</th>
                                <th scope="col">memo</th>
                                <th scope="col">paid_start</th>
                                <th scope="col">paid_end</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(sample, index) in sampleData" :key="index">
                                <td scope="row">{{sample.id}}</td>
                                <td>{{sample.name}}</td>
                                <td>{{sample.address}}</td>
                                <td>{{sample.sex}}</td>
                                <td>{{sample.birthday}}</td>
                                <td>{{sample.phone_number}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
        // さんぷるメッセージ
        sampleMessage: {
            type: String,
            default: "",
        },
        // サンプルデータ
        sampleData: {
            type: Array,
            default: () => [],
        },
    },
    // 外部コンポーネント
    components: {
        HeaderContents,
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
        getSample: function() {
            let vm = this;
            axios
                .get('/api/getSample')
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
        postSample: function() {
            let vm = this;
            let postData = {
                'postMessage': 'vue から送信したメッセージ',
            }
            axios
                .post('/api/postSample', postData)
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
