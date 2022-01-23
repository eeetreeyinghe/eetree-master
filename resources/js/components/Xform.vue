<template>
    <div>
        <el-dialog :visible.sync="dialogVisible" :show-close="false">
            <parser :form-conf="formConf" @submit="confirmSumbit" />
        </el-dialog>
    </div>
</template>
<script>
import Parser from 'form-gen-parser'
export default {
    name: 'xform',
    components: {
        Parser
    },
    data() {
        return {
            dialogVisible: false,
            formConf: {},
            url: '',
            fid: 0,
        }
    },
    mounted() {
        window.showXform = this.showXform;
    },
    methods: {
        showXform(url, fid) {
            this.url = url
            this.fid = fid
            axios({
                method: 'get',
                url: '/xforms/' + fid,
            }).then(res => {
                this.loading = false
                if (res.data.data) {
                    this.formConf = res.data.data
                    this.dialogVisible = true
                } else {
                    this.gotoPay()
                }
            });
        },
        gotoPay() {
            location.href = this.url
        },
        confirmSumbit(formData) {
            axios({
                method: 'post',
                url: '/xforms-save/' + this.fid,
                data: formData
            }).then(res => {
                this.gotoPay()
            });
        }
    }
}
</script>
