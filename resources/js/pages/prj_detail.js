$(document).ready(function(){
    $('.tab-h4').click(function() {
        $('.tab-h4').removeClass('hover-color');
        $(this).addClass('hover-color');
        var index = $('.tab-h4').index($(this))
        $('.tab-content').removeClass('show');
        $('.tab-content').eq(index).addClass('show');
        if (index == 0) {
            $('#teamPart').removeClass('hide')
        } else {
            $('#teamPart').addClass('hide')
        }
    })
    $('.prj-schedule-item').click(function() {
        $(this).closest('h4').next('.detail-content').toggleClass('show')
        $(this).find('i').toggleClass('el-icon-arrow-up').toggleClass('el-icon-arrow-down')
    })
    $('.js-showshare').click(function() {
        $('#js-share').toggle();
    })
});

Vue.component('xy-comment', require('../components/Comment').default)
Vue.component('xy-form', require('../components/Xform').default)

new Vue({
    el: '#app',
    data() {
        return {
            prjDes: $('#prjDes').html()
        }
    },
    mounted() {
        let datilsTables = $('.detail-content').find('table')
        if(datilsTables.length>0){
            for (let index = 0; index < datilsTables.length; index++) {
                const element = datilsTables[index];
                let tableHtmlDetail = $(element).html()
                $(element).before('<div class="warp-table"><table>'+tableHtmlDetail+'</table></div>')
            }
        }
        let mainTables = $('.main-content').find('table')
        if(mainTables.length>0){
            for (let index = 0; index < mainTables.length; index++) {
                const element = mainTables[index];
                let tableHtmlDetail = $(element).html()
                $(element).before('<div class="warp-table"><table>'+tableHtmlDetail+'</table></div>')
            }
        }
    }
});
