<template>
<section class="content header-buttons create-font">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Create
                        <div class="box-tools">
                        </div>
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" @submit.prevent="handleAddFreeShip" >
                    <!-- /.box-body -->
                    <div class="box-footer">

                        <input type="hidden" name="_token" value="">
                        <div class="col-sm-8 col-sm-offset-2 control-label">
                            <table class="table table-bordered table-sku-pricing create_table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Province</th>
                                        <th scope="col" class="text-center">Free Shipping Min. Spent</th>
                                        <th scope="col" class="text-center">Remark</th>
                                        <th scope="col" class="text-center">Valid Date</th>
                                        <th scope="col" class="text-center">Expired Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(each, index) in freeShip">
                                        <td>
                                            <v-select 
                                            :class="error[index].input_province"
                                            dir="auto"
                                            class="style-chooser"
                                            placeholder="Please choose zone"
                                            v-model="each.province" 
                                            :options="provinceOption"></v-select>
                                        </td>
                                        <td>
                                            <input :class="error[index].input_min" v-model="each.min_spent" name="minimum_spent[]" class="form-control input-minimum-spent minimum-spent-0 input-create" placeholder="Input Minimum Spent" width="30%">
                                        </td>
                                        <td>
                                            <input :class="error[index].input_remark" v-model="each.remark" name="remark[]" class="form-control remark-0 input-create" placeholder="Remark" width="30%">
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <Datepicker 
                                                input-class ="my-picker-class"
                                                :class="error[index].input_valid"
                                        v-model="each.valid"
                                        id="input-datetime"
                                        placeholder="*Valid Date"
                                        text-input
                                        show-now-button 
                                        format="Y-M-d"
                                        now-button-label="Current"
                                        :enable-time-picker="false" 
                                        auto-apply 
                                        :close-on-auto-apply="false" >
                                            <template #input-icon>
                                                <i class="fa fa-calendar input-slot-image"></i>
                                            </template>
                                        </Datepicker>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <Datepicker 
                                                
                                                v-model="each.experied"
                                                input-class ="my-picker-class"
                                                :class="error[index].input_expired"
                                        id="input-datetime"
                                        placeholder="*Expired At" 
                                        text-input
                                        show-now-button 
                                        format="Y-M-d"
                                        now-button-label="Current"
                                        :enable-time-picker="false"
                                        auto-apply 
                                        :close-on-auto-apply="false" >
                                            <template #input-icon>
                                                <i class="fa fa-calendar input-slot-image"></i>
                                            </template>
                                        </Datepicker>
                                                <!-- <div class="input-group date">
                                                    <input type="text" class="form-control input-required expire-date expire-date-0" name="expire_date[]" placeholder="*Expire Date" id="expire-date"><span class="input-group-addon input-expire-date-trigger">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button id="add_new" type="button" name="add_new" class="btn btn-warning center-block" @click="addNewField">
                                    <span><i class="fa fa-plus" aria-hidden="true" style="margin-right: 10px"></i>Add New Field</span>
                                </button>
          
                            </div>
                        </div>
                        <div class="col-sm-8  col-sm-offset-2">
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Submit" id="free-ship-submit">Submit</button>
                                <input type="hidden" id="number-field" value="5">
                            </div>
                        </div>

                    </div>

                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
  
</section>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification'
const toast = useToast();
const url = 'http://192.168.55.41';
export default {
    data() {
        return {
            provinceOption: [],
            freeShip: [],
            dataFreeShip: [],
            error: [],

            province: [],
            min_spent: [],
            remark: [],
            experied: [],
            valid: [],
            errorInput: 0,
            errorDateInput: 0,
        }
    },
    created() {
        this.getProvince(),
        this.addNewField()
    },
    mounted() {
        this.customeCss()
    },
    watch: {

    },
    computed: {
        
    },
    methods: {
        async getProvince() {
            const response = await axios.get(`${url}/api/get-province`);
            const data = response.data;
            const length = Object.keys(response.data.data).length
            for(let i = 0; i < length; i ++){
                this.provinceOption.push(data.data[i].province_name)
            }
        },
        async addNewField() {
             for(let i =1; i <=6; i++){
                this.freeShip.push({ 
                      province: "",
                      min_spent: "",
                      remark: "",
                      experied: "",
                      valid: "",
                      error: "",
                      index: "",
                    });
                }; 
                this.addError(6);
                this.$nextTick(function () {
                    this.customeCss();    
                })
        },
        async handleAddFreeShip() {
            
            try {
                this.setDataInsertNull();
                const length = this.freeShip.length;
                var index = 0;
                for(var i = 0; i< length; i++) {
                    if(this.freeShip[i].province === "" 
                    && this.freeShip[i].min_spent === ""
                    && this.freeShip[i].experied === ""
                    && this.freeShip[i].valid === ""
                    && this.freeShip[i].remark === "") 
                    {
    
                    }else{
                        this.freeShip[i].index = index;
                        this.province.push(this.freeShip[i].province);
                        this.min_spent.push(this.freeShip[i].min_spent);
                        this.remark.push(this.freeShip[i].remark);
                        this.valid.push(this.freeShip[i].valid);
                        this.experied.push(this.freeShip[i].experied);
                        index++;
                    }                               
                }

                if(this.province.length > 0 
                || this.min_spent.length > 0 
                || this.remark.length > 0 
                || this.valid.length > 0 
                || this.experied.length > 0){
                    const response = await axios.post(`${url}/api/freeship-add`, {
                            province: this.province,
                            min_spent: this.min_spent,
                            remark: this.remark,
                            experied: this.experied,
                            valid: this.valid,
                    });

                    this.$swal({
                            position: 'center',
                            icon: 'success',
                            title: response.data.msg,
                            showConfirmButton: false,
                            timer: 1500
                    }) 
              
                    this.$router.push('/free_shipping')
                }

                
            } catch (error) {
                this.error = []
                this.errorInput = 0;
                this.errorDateInput = 0;
                const length = this.freeShip.length;
                const errors = error.response.data.errors;
                this.addError(length) 
                for(let i = 0 ; i < length; i++) {                 
                    let index = this.freeShip.map(function (each) { return each.index; }).indexOf(i);
                    if(index > -1) {
                        if('province.'+i in errors ){
                            this.error[index].input_province = 'border border-danger';
                            this.errorInput++;
                        }
                        if('remark.'+i in errors ){
                            this.error[index].input_remark = 'input-create-error';
                            this.errorInput++;
                        }
                        if('min_spent.'+i in errors){
                            this.error[index].input_min = 'input-create-error';
                            this.errorInput++;
                        }
                        if('valid.'+i in errors){
                            this.error[index].input_valid = 'input-create-error';
                            this.errorDateInput++;
                        }
                        if('experied.'+i in errors){
                            this.error[index].input_expired = 'input-create-error';
                            this.errorDateInput++;
                        }
                    }
                    
                }                  
                    if(this.errorInput > 0) {
                        toast.warning("Input Wrong", {
                            timeout: 3000
                        });
                    }  
                    if(this.errorDateInput > 0) {
                        toast.warning("Input Date Wrong", {
                            timeout: 3000
                        });
                    }

                    

             
            }        
        },
        setDataInsertNull() {
            this.province = [];
            this.min_spent = [];
            this.remark = [];
            this.valid = [];
            this.experied = [];
        },
        customeCss() {
            $('.vs__search').css("font-size", "14px");
            $('.vs__search').css("text-align", "center");
            $('.dp__input_icon_pad').css("font-size", "14px");
            $('.dp__input').css("border-radius", "0");
            $('.vs__dropdown-toggle').css("border-radius", "0");
            $('.vs__dropdown-toggle').css("padding", "3px 0 2px");
        },
        addError(length) {
            for(var i = 0; i < length; i++) { 
                this.error.push({ 
                input_province: "",
                input_min: "",
                input_remark: "",
                input_expired: "",
                input_valid: "",
                }); 
            }     
        }

    }

}
</script>

<style scoped> 
section{
    font-size: 14px;
}
.v-select {
    position: relative;
    font-family: inherit;
    margin-top: 1px;
    width: 350px;
    margin: 0 auto;
}
.input-slot-image {
        height: 20px;
        width: auto;
        margin-left: 12px;
        border-left: 1px;       
    }
#input-datetime {
    width: auto;
    font-weight: normal;
    margin: 0 auto;
}

.input-create-error {
    outline: 1px solid red;
}

</style>