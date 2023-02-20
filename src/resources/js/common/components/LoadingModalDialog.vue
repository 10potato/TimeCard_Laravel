<template>
    <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <!-- モーダルのボディ -->
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="spinner-border" role="status"></div>
                        </div>
                        <div class="col font-14">検索中...</div>
                    </div>
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
