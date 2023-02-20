<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- モーダルのヘッダ -->
                <div class="modal-header">
                    <h5 class="modal-title"><slot name="title" /></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる" v-on:click="$emit('close-button-click')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- モーダルのボディ -->
                <div class="modal-body">
                    入力エラーが発生しました
                    <ul>
                        <li v-for="(message,index) in messages" :key="index">
                            {{message}}
                        </li>
                    </ul>
                </div>
                <!-- モーダルのフッタ -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal" v-on:click="$emit('close-button-click')">閉じる</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modalId: {
            type: String,
            default: "",
        },
        errors: {
            type: [Array, Object],
            default: []
        }
    },
    data() {
        return {
            messages:[],
        }
    },
    watch: {
        errors: function(){
            this.messages = []
            for(let key in this.errors){
                this.messages.push(this.errors[key][0])
            }
        }
    }
}
</script>
