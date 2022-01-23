Vue.component('xy-comment', require('../components/Comment').default)
Vue.component('xy-doc', require('../components/Doc').default)
Vue.component('xy-doc-node', require('../components/DocNode').default)
Vue.component('xy-folder', require('../components/Folder').default)
window.marked = require('marked')
import mediumZoom from 'medium-zoom'

let rootNode = pageOptions.content
if (rootNode && rootNode.root) {
    rootNode = rootNode.root
}
const app = new Vue({
    el: '#app',
    data: {
        rootNode
    },
    methods: {
        saveDoc() {
            this.$refs.xyDoc.saveDoc()
        }
    },
    created: function () {
        this.$nextTick(function () {
            mediumZoom('.detail-card img')
        })
    }
});
$('#mindBtn').on('click',function(){
    // iframe url:pageOptions.mindmapUrl
    let newiframe = $("<div class='newiframe'><div class='closeiframe'>关闭</div><iframe id='iframemind' src='" + pageOptions.mindmapUrl + "'></iframe></div>");
    newiframe.appendTo('body');
    $('.closeiframe').on('click',function(){
        $('.newiframe').remove()
    });
});