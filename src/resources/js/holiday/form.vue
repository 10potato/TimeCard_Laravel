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

                <div class="form-area">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="text4a">申請日</label>
                            <input type="text" class="form-control" id="add_date" placeholder="2021/06/01" readonly="readonly" v-model="add_date" v-bind:disabled="isDisabled" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="name">氏名</label>
                            <input type="text" class="form-control" id="staff_name" placeholder="鈴木タロウ" v-model="staff_name" v-bind:disabled="isDisabled"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 select_left">
                            <label for="section">所属部署</label>
                            <select class="form-control" id="section" readonly="readonly" v-model="section" v-bind:disabled="isDisabled">
                                <option value="0">選択してください</option>
                                <option value="1">本社</option>
                                <option value="2">十勝営業所</option>
                                <option value="3">伊万里営業所</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 select_right">
                            <label for="holiday_type">休暇種別</label>
                            <select class="form-control" id="holiday_type" readonly="readonly" v-model="holiday_type" v-bind:disabled="isDisabled">
                                <option value="0">選択してください</option>
                                <option value="1">有給</option>
                                <option value="2">欠勤</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="paid_start">休暇開始日</label>
                            <input type="text" class="form-control" id="paid_start" placeholder="2021/06/01" readonly="readonly" v-model="paid_start" v-bind:disabled="isDisabled" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="paid_end">休暇終了日</label>
                            <input type="text" class="form-control" id="paid_end" placeholder="2021/06/01" readonly="readonly" v-model="paid_end" v-bind:disabled="isDisabled" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="days">休暇日数</label>
                            <input type="text" class="form-control" id="days" v-model="days" v-bind:disabled="isDisabled" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="tel">連絡先</label>
                            <input type="text" class="form-control" id="tel" placeholder="090-1111-2222" v-model="tel" v-bind:disabled="isDisabled" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="paid_type">有給種別</label>
                            <select class="form-control" id="paid_type" placeholder="終日" v-model="paid_type" v-bind:disabled="isDisabled">
                                <option value="0" selected>選択してください</option>
                                <option value="1">終日</option>
                                <option value="2">半休</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="mamo">休暇理由</label>
                            <textarea class="form-control" id="memo" placeholder="理由など入力してください" v-model="memo" v-bind:disabled="isDisabled">
                            </textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button v-if="!status_no_dammy || status_no_dammy == 1 " type="button" class="btn status_btn status_btn_draft px-3 mr-3" v-on:click="openConfirmationUpdateModal(1)">下書き</button>
                        <button v-if="!status_no_dammy || status_no_dammy == 1" type="button" class="btn status_btn status_btn_add px-3 mr-3" v-on:click="openConfirmationUpdateModal(2)">申請</button>
                        <button v-if="status_no_dammy == 3" type="button" class="btn status_btn status_btn_retry px-3 mr-3" v-on:click="openConfirmationUpdateModal(2)">再申請</button>
                        <button v-if="status_no_dammy == 2" type="button" class="btn status_btn status_btn_back px-3 mr-3" v-on:click="openConfirmationUpdateModal(3)">差し戻し</button>
                        <button type="button" class="btn status_btn status_btn_cancel px-3 mr-3" v-on:click="openConfirmationCancelModal()">キャンセル</button>
                        <button v-if="status_no_dammy == 1" type="button" class="btn status_btn status_btn_del px-3" v-on:click="openConfirmationDeleteModal()">破棄</button>
                    </div>                        
                </div>
            </div>

            <!-- 更新モーダル -->
            <confirm-modal-dialog modal-id="confirmationUpdateModal" @positive-button-click="saveClick()">
                <template slot="title">
                    更新確認
                </template>
                <template slot="message">
                    データを更新します。<br />
                    よろしいですか？
                </template>
                <template slot="negative-button-content">
                    キャンセル
                </template>
                <template slot="positive-button-content">
                    OK
                </template>
            </confirm-modal-dialog>

            <!-- 削除モーダル -->
            <confirm-modal-dialog modal-id="confirmationDeleteModal" @positive-button-click="deleteHoliday()">
                <template slot="title">
                    削除確認
                </template>
                <template slot="message">
                    データを削除します。<br />
                    本当によろしいですか？
                </template>
                <template slot="negative-button-content">
                    キャンセル
                </template>
                <template slot="positive-button-content">
                    OK
                </template>
            </confirm-modal-dialog>

            <!-- キャンセルモーダル -->
            <confirm-modal-dialog modal-id="confirmationCancelModal" @positive-button-click="cancelHoliday()">
                <template slot="title">
                    キャンセル確認
                </template>
                <template slot="message">
                    データを保存せず前の画面に戻ります。<br />
                    本当によろしいですか？
                </template>
                <template slot="negative-button-content">
                    キャンセル
                </template>
                <template slot="positive-button-content">
                    OK
                </template>
            </confirm-modal-dialog>

            <!-- システムエラーモーダル -->
            <information-message-modal-dialog modal-id="systemErrorModal">
            <template slot="title">
                システムエラー
            </template>
            <template slot="message">
                エラーが発生しました。<br />
                もう一度お試しください。
            </template>
            </information-message-modal-dialog>

            <!-- バリデーションエラー -->
            <validation-error-message-modal-dialog modal-id="validationErrorModal" :errors="validationErrors" @close-button-click="closeModal()">
                <template slot="title">
                    入力内容に誤りがあります
                </template>
            </validation-error-message-modal-dialog>



            <!-- 登録完了モーダル -->
            <information-message-modal-dialog modal-id="addCompleteModal" @close-button-click="entoryModal()">
                <template slot="title">
                    情報モーダル
                </template>
                <template slot="message">
                    申請データを追加しました
                </template>
            </information-message-modal-dialog>

            <!-- 閉じるモーダル -->
            <information-message-modal-dialog modal-id="informationModal" @close-button-click="closeModal()">
                <template slot="title">
                    情報モーダル
                </template>
                <template slot="message">
                    ○○を更新しました
                </template>
            </information-message-modal-dialog>

            <!-- 検索中モーダル -->
            <loading-modal-dialog modal-id="loadingModal"></loading-modal-dialog>

        </div>
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
        // 休暇データ
        holidayData: {
            default: () => [],
        },
        // 更新フラグ
        updateFlag: {
            default: 0,
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
            // 登録ID
            id: "",
            // 状況No
            status_no: 1,
            // 状況No仮
            status_no_dammy: 1,
            // 差し戻し画面入力無効
            isDisabled: false,
            // 申請日
            add_date: "0000/00/00",
            // スタッフ名
            staff_name: "",
            // スタッフ部署
            section: "",
            // 詳細
            memo: "",
            // 休暇開始日
            paid_start: "",
            // 休暇終了日
            paid_end: "",
            // 連絡先
            tel: "",
            // 休暇種別
            holiday_type: "0",
            // 有給種別
            paid_type: "0",
            // 休暇日数
            days: 0,

            validationErrors: [],
        }
    },
    // モデル監視用
    watch: {
        paid_start: function(newVal) {
            this.countDay();
        },
        paid_end: function(newVal) {
            this.countDay();
        }        
    },

    // 初回実行
    mounted: function () {
        let vm = this;

        vm.add_date = vm.todayDate();

        if(vm.updateFlag == 1) {
            vm.id = vm.holidayData.id;
            vm.status_no = vm.holidayData.status_no;
            vm.status_no_dammy = vm.holidayData.status_no;
            vm.isDisabled = false;
            vm.add_date = vm.formatDate(new Date(vm.holidayData.add_date));
            vm.staff_name = vm.holidayData.staff_name;
            vm.section = vm.holidayData.section;
            vm.paid_start = vm.formatDate(new Date(vm.holidayData.paid_start));
            vm.paid_end = vm.formatDate(new Date(vm.holidayData.paid_end));
            vm.tel = vm.holidayData.tel;
            vm.holiday_type = vm.holidayData.holiday_type;
            vm.paid_type = vm.holidayData.paid_type;
            vm.days = vm.dayLoad(this.holidayData.paid_end, vm.holidayData.paid_start);
        }
        // 申請中・差し戻し入力フォーム無効
        if(vm.status_no_dammy == 2) {
            vm.isDisabled = true;
        }

        // 申請年月日
        $("#add_date")
        .datetimepicker({
            dayViewHeaderFormat: "YYYY年M月",
            tooltips: {
            close: "閉じる",
            selectMonth: "月を選択",
            prevMonth: "前月",
            nextMonth: "次月",
            selectYear: "年を選択",
            prevYear: "前年",
            nextYear: "次年",
            selectTime: "時間を選択",
            selectDate: "日付を選択",
            prevDecade: "前期間",
            nextDecade: "次期間",
            selectDecade: "期間を選択",
            prevCentury: "前世紀",
            nextCentury: "次世紀",
            },
            // format: "YYYY/MM/DD",
            format: "YYYY-MM-DD",
            locale: "ja",
            showClose: false,
            ignoreReadonly: true,
            widgetPositioning: {
            horizontal: "auto",
            vertical: "bottom",
            },
        })
        .on("dp.change", function(e) {
            vm.add_date = e.date.format("YYYY-MM-DD");
        });
        
        // 休暇開始年月日
        $("#paid_start")
        .datetimepicker({
            dayViewHeaderFormat: "YYYY年M月",
            tooltips: {
            close: "閉じる",
            selectMonth: "月を選択",
            prevMonth: "前月",
            nextMonth: "次月",
            selectYear: "年を選択",
            prevYear: "前年",
            nextYear: "次年",
            selectTime: "時間を選択",
            selectDate: "日付を選択",
            prevDecade: "前期間",
            nextDecade: "次期間",
            selectDecade: "期間を選択",
            prevCentury: "前世紀",
            nextCentury: "次世紀",
            },
            // format: "YYYY/MM/DD",
            format: "YYYY-MM-DD",
            locale: "ja",
            showClose: false,
            ignoreReadonly: true,
            widgetPositioning: {
            horizontal: "auto",
            vertical: "bottom",
            },
        })
        .on("dp.change", function(e) {
            vm.paid_start = e.date.format("YYYY-MM-DD");
        });
        
        // 休暇終了年月日
        $("#paid_end")
        .datetimepicker({
            dayViewHeaderFormat: "YYYY年M月",
            tooltips: {
            close: "閉じる",
            selectMonth: "月を選択",
            prevMonth: "前月",
            nextMonth: "次月",
            selectYear: "年を選択",
            prevYear: "前年",
            nextYear: "次年",
            selectTime: "時間を選択",
            selectDate: "日付を選択",
            prevDecade: "前期間",
            nextDecade: "次期間",
            selectDecade: "期間を選択",
            prevCentury: "前世紀",
            nextCentury: "次世紀",
            },
            format: "YYYY-MM-DD",
            locale: "ja",
            showClose: false,
            ignoreReadonly: true,
            widgetPositioning: {
            horizontal: "auto",
            vertical: "bottom",
            },
        })
        .on("dp.change", function(e) {
            vm.paid_end = e.date.format("YYYY-MM-DD");
        });
        
    },
    // 関数
    methods: {
        // 更新確認モーダル呼び出し
        openConfirmationUpdateModal: function(val) {
            this.status_no = val;
            $('#confirmationUpdateModal').modal('show');
        },
        // 削除確認モーダル呼び出し
        openConfirmationDeleteModal: function() {
            $('#confirmationDeleteModal').modal('show');
        },
        // キャンセル確認モーダル呼び出し
        openConfirmationCancelModal: function() {
            if(this.status_no == 2 || this.status_no == 3) {
                window.location.href = '/holiday/list/';
            } else {
                $('#confirmationCancelModal').modal('show');
            }
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
        entoryModal: function() {
            console.log('登録完了！')
            window.location.href = '/holiday/list/';
        },
        closeModal: function() {
            console.log('close')
        },
        negativeButtonClick: function() {
            console.log('キャンセル')
        },
        positiveButtonClick: function() {
            console.log('OK')
        },

        // 終了日ー開始日計算
        countDay: function() {
            if(!this.paid_start || !this.paid_end) {
                this.days = 0;
            } else {
                let dateStart = new Date(this.paid_start);
                let dateEnd = new Date(this.paid_end);
                let count =  (dateEnd - dateStart) / 86400000 + 1;
                this.days = count; 
            }
        },
        // 終了日ー開始日計算（読み込み時）
        dayLoad: function(paid_end, paid_start) {
            if(!paid_end || !paid_start) {
                return "";
            } else {
                let dateStart = new Date(paid_start);
                let dateEnd = new Date(paid_end);
                let count =  ((dateEnd - dateStart) / 86400000) + 1;
                return count; 

            }
        },

        // 本日の日付取得
        todayDate: function() {
            var today = new Date();
            return this.formatDate(today);
        },

        // 日付をYYYY-MM-DDの書式で返すメソッド
        formatDate: function(dt) {
            var y = dt.getFullYear();
            var m = ('00' + (dt.getMonth()+1)).slice(-2);
            var d = ('00' + dt.getDate()).slice(-2);
            return (y + '-' + m + '-' + d);
        },

        // 保存ボタン押下
        saveClick: function() {
            // this.status_no = this.status_no_dammy;
            if(!this.id) {
                this.addHoliday();
            } else {
                this.updateHoliday();
            }
        },
        // 破棄ボタン押下
        deleteClick: function() {
            this.deleteHoliday();
        },

        // 申請情報の新規追加
        addHoliday: function() {
        let vm = this;

        let formData = this.createPostData();

        // 申請情報登録処理
        axios
            .post("/api/holiday/add", formData)
            .then((response) => {
                $("#addCompleteModal").modal("show");
            })
            .catch((error) => {
            if (error.response.data.errors != null) {
                vm.validationErrors = error.response.data.errors;
                $("#validationErrorModal").modal("show");
            } else {
                $("#systemErrorModal").modal("show");
            }
            });
        },


        // 申請情報の更新
        updateHoliday: function() {
        let vm = this;

        let formData = this.createPostData();

        // 申請情報更新処理
        axios
            .post("/api/holiday/update", formData)
            .then((response) => {
                window.location.href = '/holiday/list/';
                // $("#updateCompleteModal").modal("show");
            })
            .catch((error) => {
            if (error.response.data.errors != null) {
                vm.validationErrors = error.response.data.errors;
                $("#validationErrorModal").modal("show");
            } else {
                $("#systemErrorModal").modal("show");
            }
            });
        },

        // post生成
        createPostData: function() {
            let vm = this;
            var formData = new FormData();
            // 申請情報
            formData.append("status_no", vm.status_no);
            formData.append("add_date", vm.add_date);
            formData.append("staff_name", vm.staff_name);
            formData.append("section", vm.section);
            formData.append("memo", vm.memo);
            formData.append("paid_start", vm.paid_start);
            formData.append("paid_end", vm.paid_end);
            formData.append("tel", vm.tel);
            formData.append("holiday_type", vm.holiday_type);
            formData.append("paid_type", vm.paid_type);
            formData.append("days", vm.days);

            // 更新の場合はidも渡す　忘れていた 6/8
            if (this.id) {
                formData.append("id", vm.id);
            }

            return formData;
        },

        // 申請データの削除
        deleteHoliday: function() {
            let vm = this;

            let postData = {
                id: vm.id,
            };

            // 申請データ削除処理
            axios
                .post("/api/holiday/delete", postData)

                .then((response) => {
                    window.location.href = '/holiday/list/';
                })
                .catch((error) => {
                if (error.response.data.errors != null) {
                    vm.validationErrors = error.response.data.errors;
                    $("#validationErrorModal").modal("show");
                } else {
                    $("#systemErrorModal").modal("show");
                }
            });
                
        },

        // 入力データのキャンセル
        cancelHoliday: function() {
            window.location.href = '/holiday/list/';
        },

    },
    // 共通vueファイル読み込み
    mixins: [
        Vue.extend(require('../common/mixin/PageTransition.vue')),
        Vue.extend(require('../common/mixin/Common.vue')),
    ]
}
</script>
