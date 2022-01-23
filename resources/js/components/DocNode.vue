<template>
    <div :class="{'has-child': docNode.children && docNode.children.length > 0 , 'collapsed': collapse }">
        <div class="title no-child">
            <span class="dot-content" @click="collapse = !collapse">{{ collapse ? '+' : '-'}}</span>
            <span class="dot" :class="{'can-unfold': collapse}" @click.prevent.stop="triggerClick(docNode.data)"></span>
            <a v-if="docNode.data.hyperlink" :href="docNode.data.hyperlink" target="_blank">{{ docNode.data.text }}</a>
            <span v-else>{{ docNode.data.text }}</span>
            <i v-if="docNode.data.note" class="fa fa-file-text-o noteicon" @click="toggleNote = !toggleNote"></i>
            <p v-if="docNode.data.note" class="previewer-content" :class="{'d-none': !toggleNote}" v-html="docNode.data.note"></p>
            <img v-if="docNode.data.image" :src="docNode.data.image">
            <div v-if="docNode.data.video" v-html="docNode.data.video" class="doc-video"></div>
        </div>
        <div class="card-list" :class="['card-list-' + depth, {'hide': collapse}]" v-if="docNode.children && docNode.children.length > 0">
            <xy-doc-node v-for="child in docNode.children" :key="child.data.id"
                :depth="depth + 1"
                :doc-node="child"
                @nodeClick="nodeClick"
            ></xy-doc-node>
        </div>
    </div>
</template>
<script>
	export default {
		name: 'xydoc',
        data() {
            return {
                collapse: false,
                toggleNote: false,
            }
        },
		props: {
            docNode: Object,
            depth: Number,
        },
        created() {
            if (this.docNode.data.note) {
                this.docNode.data.note = marked(this.docNode.data.note);
            }
            if (this.depth > 3 && window.matchMedia('(max-width: 576px)').matches) {
                this.collapse = true
            }
        },
        methods: {
            triggerClick(item) {
                this.$emit('nodeClick', item)
            },
            nodeClick(item) {
                this.$emit('nodeClick', item)
            },
        }
	}
</script>