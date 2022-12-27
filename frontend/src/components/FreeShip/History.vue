<template>
<section class="content header-buttons ">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">History</h3>

                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <router-link to="/free_shipping" class="btn btn-sm btn-default form-history-back">
                                <i class="fa fa-arrow-left"></i>&nbsp;Back
                            </router-link>

                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover history_table">
                        <tbody>
                            <tr>
                                <th>Module<a :class="sortIconModule" href="#" @click="sort('module')"></a>
                                </th>
                                <th>Operation<a :class="sortIconOperation" href="#" @click="sort('operation')"></a>
                                </th>
                                <th>Create date<a :class="sortIconCreateDate" href="#" @click="sort('createdate')"></a>
                                </th>
                                <th>User<a :class="sortIconUser" href="#" @click="sort('user')"></a>
                                </th>
                            </tr>
                            <tr v-for="(history,index) in listHistory" :key="index">
                                <td>
                                    {{history.module}}
                                </td>
                                <td v-html="history.operation">
                                    
                                </td>
                                <td>
                                    {{history.created_at}}
                                </td>
                                <td>
                                    {{history.name}}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    Showing <b>{{from}}</b> to <b>{{to}}</b> of <b>{{total}}</b> entries
                    <div  class="pagination pull-right" id="vue-pagination">
                        <pagination  v-model="page" :records="total" :per-page="numberHistoryPerPage"  @paginate="getHistoryList" />
                    </div> 
                    <label class="control-label pull-right" style="margin-right: 10px; font-weight: 100;">

                        <small>Show</small>&nbsp;
                        <select class="input-sm grid-per-pager" name="per-page" v-model="perPage">
                            <option >20</option>
                            <option >50</option>
                            <option >100</option>
                        </select>
                        &nbsp;<small>entries</small>
                    </label>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>
</template>

<script>
import axios from 'axios'
import Pagination from 'v-pagination-3';
const url = 'http://192.168.55.41';
export default {
    components: {Pagination},
    data() {
        return {
            listHistory: [],
            page: 1,
            numberHistoryPerPage: 20,
            perPage: 20,
            total: 0,
            from: 0,
            to: 0,
            sortProvince: '',
            inputProvince: '',
            
                sortIconModule: 'fa fa-fw fa-sort',
                sortIconOperation: 'fa fa-fw fa-sort',
                sortIconCreateDate: 'fa fa-fw fa-sort',
                sortIconUser: 'fa fa-fw fa-sort',
            
                sortBy: '',
                sortValue: '',
                sortModule: '',
                sortOperation: '',
                sortCreateDate: '',
                sortUser: '',
            
            
        }
    },
    created() {
        this.getHistoryList()
    },
    mounted() {

    },
    watch: {
        perPage() {
            this.page = 1;
            this.getHistoryList()
        },
    },
    methods: {
        async getHistoryList() {
            const response = await axios.get(`
            ${url}/api/history?page=${this.page}&perPage=${this.perPage}&${this.sortBy}=${this.sortValue}
            `);
            this.loadHistory(response);
        },

        loadHistory(response){
            this.listHistory = response.data.data;
            this.total = response.data.count;
            this.numberHistoryPerPage = response.data.numberHistoryPerPage;
            var length = Object.keys(response.data.data).length;

            var offset = this.numberHistoryPerPage * (this.page -1);
            this.from = offset + 1;
            if(length === 0){
                this.from = offset ;
            }                  
            this.to = offset + length;
        },

        sort(value) {
            switch (value)
            {
            case 'module':
                this.sortIconOperation = 'fa fa-fw fa-sort';
                this.sortIconCreateDate = 'fa fa-fw fa-sort';
                this.sortIconUser = 'fa fa-fw fa-sort';
                this.sortOperation = '';
                this.sortCreateDate = '';
                this.sortUser = '';
                if(this.sortBy !== 'sortModule') {
                    this.sortValue = '';
                }
                this.sortBy = 'sortModule';
                if(this.sortModule !== ''){
                    if(this.sortIconModule === 'fa fa-fw fa-sort-amount-desc'){
                        this.sortIconModule='fa fa-fw fa-sort-amount-asc';
                        this.sortModule='asc'; 
                        this.sortValue = 'asc';
                    }else{
                        this.sortIconModule='fa fa-fw fa-sort-amount-desc';
                        this.sortModule='desc';  
                        this.sortValue = 'desc';
                    }
                }else{
                    this.sortIconModule='fa fa-fw fa-sort-amount-desc';
                    this.sortModule='desc';
                    this.sortValue = 'desc';
                }
                break;
            case 'operation':
                this.sortIconModule = 'fa fa-fw fa-sort',
                this.sortIconCreateDate = 'fa fa-fw fa-sort';
                this.sortIconUser = 'fa fa-fw fa-sort';
                this.sortModule = '';
                this.sortCreateDate = '';
                this.sortUser = '';
                if(this.sortBy !== 'sortOperation') {
                    this.sortValue = '';
                    console.log(this.sortValue)
                }
                this.sortBy = 'sortOperation';
                if(this.sortOperation !== ''){
                        if(this.sortIconOperation === 'fa fa-fw fa-sort-amount-desc'){
                            this.sortIconOperation='fa fa-fw fa-sort-amount-asc';
                            this.sortOperation='asc'; 
                            this.sortValue = 'asc';
                        }else{
                            this.sortIconOperation='fa fa-fw fa-sort-amount-desc';
                            this.sortOperation='desc';  
                            this.sortValue = 'desc';
                        }
                }else{
                    this.sortIconOperation='fa fa-fw fa-sort-amount-desc';
                    this.sortOperation='desc';
                    this.sortValue = 'desc';
                }
                break;
            case 'createdate':
                this.sortIconModule = 'fa fa-fw fa-sort',
                this.sortIconOperation = 'fa fa-fw fa-sort';
                this.sortIconUser = 'fa fa-fw fa-sort';
                this.sortModule = '';
                this.sortOperation = '';
                this.sortUser = '';
                if(this.sortBy !== 'sortCreateDate') {
                    this.sortValue = '';
                }
                this.sortBy = 'sortCreateDate';
                if(this.sortCreateDate !== ''){
                            if(this.sortIconCreateDate === 'fa fa-fw fa-sort-amount-desc'){
                                this.sortIconCreateDate='fa fa-fw fa-sort-amount-asc';
                                this.sortCreateDate='asc'; 
                                this.sortValue = 'asc';
                            }else{
                                this.sortIconCreateDate='fa fa-fw fa-sort-amount-desc';
                                this.sortCreateDate='desc';  
                                this.sortValue = 'desc';
                            }
                }else{
                    this.sortIconCreateDate='fa fa-fw fa-sort-amount-desc';
                    this.sortCreateDate='desc';
                    this.sortValue = 'desc';
                }
                break;
            case 'user':
                this.sortIconModule = 'fa fa-fw fa-sort',
                this.sortIconOperation = 'fa fa-fw fa-sort';
                this.sortIconCreateDate = 'fa fa-fw fa-sort';
                this.sortModule = '';
                this.sortOperation = '';
                this.sortCreateDate = '';
                if(this.sortBy !== 'sortUser') {
                    this.sortValue = '';
                }
                this.sortBy = 'sortUser';
                if(this.sortUser !== ''){
                                if(this.sortIconUser === 'fa fa-fw fa-sort-amount-desc'){
                                    this.sortIconUser='fa fa-fw fa-sort-amount-asc';
                                    this.sortUser='asc'; 
                                    this.sortValue = 'asc';
                                }else{
                                    this.sortIconUser='fa fa-fw fa-sort-amount-desc';
                                    this.sortUser='desc';  
                                    this.sortValue = 'desc';
                                }
                }else{
                    this.sortIconUser='fa fa-fw fa-sort-amount-desc';
                    this.sortUser='desc';
                    this.sortValue = 'desc';
                }
                break;
            }            
            this.getHistoryList()
        },

    }
}
</script>

<style scoped> 
.history_table {
    width: 100%;
}
.history_table > tbody > tr > td:nth-of-type(1) {
    width: 12%;
}
.history_table > tbody > tr > td:nth-of-type(2) {
    width: 70%;
}
#vue-pagination {
    margin-top: -40px;
    margin-bottom: 0;
}
</style>