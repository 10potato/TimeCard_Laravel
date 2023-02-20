<script>
export default {
    methods: {

        // 日付をフォーマットする
        formatDate: function(date, format) {
            var weekDay = ["日", "月", "火", "水", "木", "金", "土"];
            if (!format) format = 'YYYY-MM-DD hh:mm:ss.SSS';
            format = format.replace(/YYYY/g, date.getFullYear());
            format = format.replace(/MM/g, ('0' + (date.getMonth() + 1)).slice(-2));
            format = format.replace(/M/g, date.getMonth() + 1);
            format = format.replace(/DD/g, ('0' + date.getDate()).slice(-2));
            format = format.replace(/D/g, date.getDate());
            format = format.replace(/W/g, weekDay[date.getDay()]);
            format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
            format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
            format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
            if (format.match(/S/g)) {
                var milliSeconds = ('00' + date.getMilliseconds()).slice(-3);
                var length = format.match(/S/g).length;
                for (var i = 0; i < length; i++) format = format.replace(/S/, milliSeconds.substring(i, i + 1));
            }
            return format;
        },

        // 時刻を時分(hh:mm)フォーマットする
        formatTime: function(time) {
            var tStr = time.split(":");
            if (tStr.length >= 2) {
                time = tStr[0]+':'+tStr[1];
            }
            return time
        },

        // 前0埋め
        formatZeroPadding: function(num, length) {
            if(isNaN(num)) return num;
            return ( Array(length).join('0') + num ).slice( -length );
        },

        // 少数点パース処理
        parseSmallNumber: function(val) {
            var strVal = String(val);

            // .00 を削除
            strVal = strVal.replace('.000','',strVal);

            // .判定
            if (strVal.indexOf('.') > 0) {

                while (strVal.lastIndexOf('0') == (strVal.length - 1)) {
                    strVal = strVal.slice( 0, -1 ) ;
                }
            }

            return strVal;
        },

        /**
         * 月初を取得する
         * @param {Date} date - 日付オブジェクト
         * @return {Date} 月初
         */
        getFirstDate: function (date) {
            return new Date(date.getFullYear(), date.getMonth(), 1);
        },

        /**
         * 月末を取得する
         * @param {Date} date - 日付オブジェクト
         * @return {Date} 月初
         */
        getLastDate: function (date) {
            return new Date(date.getFullYear(), date.getMonth() + 1, 0);
        },

    }

}
</script>
