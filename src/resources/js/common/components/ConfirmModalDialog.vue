<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- モーダルのヘッダ -->
                <div class="modal-header">
                    <h5 class="modal-title"><slot name="title" /></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる" v-on:click="$emit('button-click')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- モーダルのボディ -->
                <div class="modal-body">
                    <slot name="message" />
                </div>
                <!-- モーダルのフッタ -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal" v-on:click="$emit('negative-button-click')"><slot name="negative-button-content" /></button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" v-on:click="$emit('positive-button-click')"><slot name="positive-button-content" /></button>
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
        }
    }
}
</script>
