<template>
 <div>
    <div class="flex flex-between flex-center-v margin-b-25">
      <h2 class="right-tab-title">地址管理</h2>
    </div>
    <AddressList :ucenter="true"/>
 </div>
</template>

<script>
import AddressList from '@/js/components/AddressList.vue'
export default {
  name: 'addressList',
  components: { AddressList },
}
</script>
