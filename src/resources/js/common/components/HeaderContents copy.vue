<template>
    <section>
        <header class="fixed-top">
            <div class="row m-0 align-items-center header">

                <div class="col-auto">{{title}}</div>

                <div class="col">&nbsp;</div>

                <div class="col-auto logout">
                    <button class="btn btn-outline-light btn-sm" v-on:click="logout()">ログアウト</button>
                </div>

            </div>
        </header>
    </section>
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
