<template>
    <div class="fixed-side">
        <div class="company text-white">ABCDEシステム</div>
        <div id="humberger">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <aside id="sidebar">
            <nuv id="global-nav">
                <ul class="list-group m-0 p-0">
                    <li class="list-group-item menu_select"><a href="/holiday/list">休暇情報一覧</a></li>
                    <li class="list-group-item"><a href="/holiday/form">休暇申請</a></li>
                    <li class="list-group-item"><a href="">設定</a></li>
                </ul>
            </nuv>
        </aside>
    </div>
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
