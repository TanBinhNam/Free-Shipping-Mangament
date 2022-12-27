<template>
<section class="content header-buttons">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit</h3>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <router-link to="/free_shipping" class="btn btn-sm btn-default">
                                <i class="fa fa-list"></i>&nbsp;List
                            </router-link>

                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form  class="form-horizontal" @submit.prevent="handleUpdate()">
                    <div class="box-body">

                        <div class="fields-group">
                            <div class="form-group">
                                <label class="col-sm-2 control-label title">ID</label>
                                <div class="col-sm-8">
                                    <div class="box box-solid box-default no-margin">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            {{freeshipInfo.id}}&nbsp;
                                        </div>
                                        <!-- /.box-body -->
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label title">Province</label>
                                <div class="col-sm-8">
                                    <div class="box box-solid box-default no-margin">
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            {{freeshipInfo.province}}&nbsp;
                                        </div>
                                        <!-- /.box-body -->
                                    </div>

                                </div>
                            </div>
                            <div class="form-group 1">

                                <label for="minimum_spent" class="col-sm-2 control-label title">Minimum spent</label>

                                <div class="col-sm-8">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                        <input 
                                        :class="input_min_spent"
                                        v-model="freeshipInfo.minimumSpent" 
                                        type="text" id="minimum_spent" name="minimum_spent" class="form-control minimum_spent" placeholder="Input Minimum spent">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group 1">

                                <label for="remark" class="col-sm-2 control-label title">Remark</label>

                                <div class="col-sm-8">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                        <input 
                                        :class="input_remark"
                                        v-model="freeshipInfo.remark" 
                                        type="text" id="remark" name="remark" class="form-control remark" placeholder="Input Remark">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group 1">

                                <label for="valid_date" class="col-sm-2 control-label title">Valid Date</label>

                                <div class="col-sm-8">

                                    <div class="input-group">

                                        <!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                        <input v-model="freeshipInfo.validDate" style="width: 110px" type="text" id="valid_date" name="valid_date" class="form-control valid_date" placeholder="Input Valid Date">
                                     -->
                                     <Datepicker v-model="freeshipInfo.validDate"
                                        :class="input_valid"
                                        id="input-datetime"
                                        placeholder="Input Valid Date"
                                        text-input
                                        show-now-button 
                                        format="Y-M-d"
                                        now-button-label="Current"
                                        :enable-time-picker="false" 
                                        auto-apply 
                                        :close-on-auto-apply="false" required >
                                            <template #input-icon>
                                                <i class="fa fa-calendar input-slot-image"></i>
                                            </template>
                                        </Datepicker>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group 1">

                                <label for="expired_at" class="col-sm-2 control-label title">Expired At</label>

                                <div class="col-sm-8">

                                    <div class="input-group">

                                        <!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
                                        <Datepicker
                                        :class="input_expired"
                                        v-model="freeshipInfo.expiredAt" 
                                        id="input-datetime"
                                        placeholder="Input Expired At" 
                                        text-input
                                        show-now-button 
                                        format="Y-M-d"
                                        now-button-label="Current"
                                        :enable-time-picker="false"
                                        auto-apply 
                                        :close-on-auto-apply="false" required >
                                            <template #input-icon>
                                                <i class="fa fa-calendar input-slot-image"></i>
                                            </template>
                                        </Datepicker>
                              
                                        <!-- <input @click="datepicker('expired_at')" :value="freeshipInfo.expiredAt" style="width: 110px" type="text" name="expired_at" class="form-control expired_at" placeholder="Input Expired At"> -->
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" name="user_registered" value="51" class="user_registered">
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-sm-8">

                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Submit">Submit</button>
                            </div>

                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>

</section>
</template>

<script>
import axios from 'axios'
import { useToast } from 'vue-toastification'
const toast = useToast();
const url = 'http://192.168.55.41';
export default {

    data() {
        return {
            freeshipInfo: {
                id: '',
                province: '',
                minimumSpent: '',
                remark: '',
                validDate: '',
                expiredAt: '',
            },
                input_min_spent: '',
                input_remark: '',
                input_valid: '',
                input_expired: '',
 
        }
    },
    created() {
        this.getInfo()

    },
    mounted() {
        $('.dp__input_icon').addClass('input-group-addon');
        $('.dp__input_icon').css('width', '38px');
        $('.dp__input_icon').css('margin-left', '1px');
        $('.dp__input_icon').css('border-left', '0');

        $('.dp__input_icon_pad').css("font-size", "14px");
        $('.dp__input_icon_pad').css('padding-left', '50px');
        $('.dp__input_icon_pad').css("border-radius", "0");
    },
    computed: {

    },
    methods: {
        async getInfo() {
            try {         
                const response = await axios.get(`${url}/api/getfreeship/${this.$route.params.id}`);
                let data = response.data.data;
                this.freeshipInfo.id = data.id;
                this.freeshipInfo.province = data.province;
                this.freeshipInfo.minimumSpent = data.minimum_spent;
                this.freeshipInfo.remark = data.remark;
                this.freeshipInfo.validDate = data.valid_date;
                this.freeshipInfo.expiredAt = data.expired_at;
            } catch (error) {
                alert('Không tồn tại');
                
            }
        },
        async handleUpdate() {
            try {
                const response = await axios.post(`${url}/api/freeship-update`, {
                    id: this.freeshipInfo.id,
                    province: this.freeshipInfo.province,
                    minimum_spent: this.freeshipInfo.minimumSpent,
                    remark: this.freeshipInfo.remark,
                    valid_date: this.freeshipInfo.validDate,
                    expired_at : this.freeshipInfo.expiredAt,
                  }          
                );   
                    this.$swal({
                            position: 'center',
                            icon: 'success',
                            title: response.data.msg,
                            showConfirmButton: false,
                            timer: 1500
                    }) 
                
                this.$router.push('/free_shipping')
            } catch (error) {
                this.setNullError();
                const errors = error.response.data.errors;
                if('remark' in errors){
                    this.input_remark = 'input-error';
                }
                if('minimum_spent' in errors){
                    this.input_min_spent = 'input-error';
                }
                if('valid_date' in errors ){
                    this.input_valid = 'input-error';
                }
                if('expired_at' in errors){
                    this.input_expired = 'input-error';
                }
                if('remark' in errors || 'minimum_spent' in errors){
                    toast.error("Input Wrong", {
                        timeout: 2000
                    });
                }
                if('valid_date' in errors || 'expired_at' in errors){
                    toast.error("Input Date Wrong", {
                        timeout: 2000
                    });
                }
            }
        },

        setNullError() {
                this.input_min_spent = '';
                this.input_remark = '';
                this.input_valid = '';
                this.input_expired = '';
        }


    

    }
}
</script>


<style scoped>
.title {
    font-weight: bold;
}
    .input-slot-image {
        height: 16px;
        width: auto;
        /* margin-left: 12px;
        border-left: 1px;        */
    }
        #input-datetime {
            width: 170px;
            font-weight: normal;
}

.input-error {
    outline: 1px solid red;
}
</style>