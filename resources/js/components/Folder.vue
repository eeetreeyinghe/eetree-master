<template>
  <ul class="move-folder">
    <li v-for="item in list" :key="item.id" @click.prevent.stop="triggerClick(item)" :class="{ 'select-folder': item.selected }">
      <p>{{ item.name }}</p>
      <xy-folder :list="item.children" @nodeClick="nodeClick"></xy-folder>
    </li>
  </ul>
</template>
<script>
	export default {
		name: 'folder',
		props: {
			list: Array
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