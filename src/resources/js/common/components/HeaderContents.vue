<template>
    <header>
        <div class="row align-items-center">
            <div class="col-2">{{title}}</div>

            <div class="col-7">&nbsp;</div>

            <div class="col-2 pt-3 pb-3 header_name">鈴木タロウ</div>

            <!-- ログアウトボタン非表示 -->
            <!-- <div class="col-auto logout">
                <button class="btn btn-outline-light btn-sm" v-on:click="logout()">ログアウト</button>
            </div> -->

        </div>
    </header>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                default: ""
            },
        },
        methods: {
            logout: function() {
                location.href = '/logout';
            },
        },
        mixins: [
            Vue.extend(require('../mixin/PageTransition.vue')) 
        ]
    }
</script>
