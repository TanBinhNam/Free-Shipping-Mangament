<template>
<section class="content border-round">
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-top: none">

                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="pull-right">
                        <div class="btn-group pull-right pr-3">
                            <router-link to="/free_shipping/history" class="btn btn-sm btn-twitter">
                                <i class="fa fa-history"></i>&nbsp;&nbsp;History
                            </router-link>
                        </div>
                        <div class="btn-group pull-right pr-3">
                            <router-link to="/free_shipping/create" class="btn btn-sm btn-success">
                                <i class="fa fa-save"></i>&nbsp;&nbsp;New
                            </router-link>
                        </div>
                    </div>

                    <div class="pull-left">
                        <div class="form-inline pull-right">
                            
                                <fieldset>
                                    <div class="input-group input-group-sm pr-2 float-left">
                                        <span class="input-group-addon"><strong>Province</strong></span>
                                        <input v-model="inputProvince" type="text" class="form-control" placeholder="Province" name="province" >
                                    </div>
                                    <div class="btn-group btn-group-sm float-left">
                                        <button @click="search()" type="submit" class="btn btn-primary">Filter</button>
                                        <button @click="clearSearch()"   class="btn btn-warning">Reset Filter</button>
                                    </div>
                                </fieldset>
                      
                        </div>

                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr >
                                <th>ID</th>
                                <th>Province
                                    <a :class="sortIcon" href="#" @click="sort()"></a>
                                    <!-- <a class="fa fa-fw fa-sort-amount-asc" href="#"></a> -->
                                </th>
                                <th>Minimum spent</th>
                                <th>Valid Date</th>
                                <th>Expired At</th>
                                <th>Updated By</th>
                                <th>Action</th>
                            </tr>
                    
                            <tr v-if="listFreeShip.length > 0" v-for="(freeship,index) in listFreeShip" :key="index">
                                <td>
                                    {{freeship.id}}
                                </td>
                                <td>
                                    {{freeship.province}}
                                </td>
                                <td>
                                    {{numberFormat(freeship.minimum_spent)}}
                                </td>
                                <td>
                                    {{freeship.valid_date}}
                                </td>
                                <td>
                                    {{freeship.expired_at}}
                                </td>
                                <td>
                                    {{freeship.user.name}}
                                </td>
                                <td>
                                    <a @click="update(freeship.id)" href="#" class="pr-2">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" @click="deleteAlert(freeship.id)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>

                            </tr>
                            <tr v-else>
                                <td colspan="7" class="text-center">Không có dữ liệu</td>                             
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    Showing <b>{{from}}</b> to <b>{{to}}</b> of <b>{{total}}</b> entries
                    <div  class="pagination float-right " id="vue-pagination">
                        <pagination v-model="page" :records="total" :per-page="numberFreeShipPerPage"  @paginate="getFreeShip()" />

                    </div> 

                    
     
                    <label class="control-label float-right">

                        <small>Show</small>&nbsp;
                        <select class="input-sm" name="per-page" v-model="perPage">
                            <option >20</option>
                            <option >50</option>
                            <option >100</option>
                        </select>
                        &nbsp;<small>entries</small>
                    </label>

                </div>
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
            listFreeShip: [],
            page: 1,
            numberFreeShipPerPage: 20,
            perPage: 20,
            total: 0,
            from: 0,
            to: 0,
            sortProvince: '',
            inputProvince: '',
            sortIcon: 'fa fa-fw fa-sort',
            resultDelete: 0,
        }
    },
    created() {
        this.getFreeShip()

    },
    watch: {
        perPage() {
            this.getFreeShip()
        },
        sortProvince() {
            this.getFreeShip()
        }
    },
    computed: {

    },
    methods: {
        clickCallback (pageNum) {
            console.log(pageNum)
        },
        async getFreeShip() {
            const response = await axios.get(`
            ${url}/api/freeship?page=${this.page}&province=${this.inputProvince}&perPage=${this.perPage}&sortProvince=${this.sortProvince}
            `);

            this.loadFreeShip(response)
        },

        search() {
            this.page = 1;
            this.getFreeShip();
        },

        clearSearch() {
            this.inputProvince = '';
            this.page = 1;
            this.getFreeShip();
        },

        sort() {
            if(this.sortProvince !== ''){
                if(this.sortIcon === 'fa fa-fw fa-sort-amount-desc'){
                    this.sortIcon='fa fa-fw fa-sort-amount-asc';
                    this.sortProvince='asc'; 
                }else{
                    this.sortIcon='fa fa-fw fa-sort-amount-desc';
                    this.sortProvince='desc';  
                }
            }else{
                this.sortIcon='fa fa-fw fa-sort-amount-desc';
                this.sortProvince='desc';
            }
        },

        update(id) {
            this.$router.push('/free_shipping/'+id+'/edit');
        },
        
        async delete(id) {
            try {
                const response = await axios.get(`
                ${url}/api/freeship-delete/${id}
                `);
                    this.$swal({
                            position: 'center',
                            icon: 'success',
                            title: response.data.msg,
                            showConfirmButton: false,
                            timer: 1500
                    }) 
                    this.getFreeShip();

            } catch (error) {
                this.$swal({
                        position: 'center',
                        icon: 'error',
                        title: error.response.data.msg,
                        text:  error.response.data.error,
                        showConfirmButton: false,
                        timer: 2300
                })
            }
        },

        deleteAlert(id) {
            this.$swal({
                title: 'You want delete id:'+id,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Cancel',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
              }).then((result) => {
                if (result.isConfirmed) {

                    this.delete(id);

                } else if (result.dismiss === this.$swal.DismissReason.cancel) {
                    this.$swal({
                        position: 'center',
                        icon: 'error',
                        title: 'Cancel Delete',
                        showConfirmButton: false,
                        timer: 1500
                    })
                  }
              })
        },

        loadFreeShip(response){
            this.listFreeShip = response.data.data;
            this.total = response.data.count;
            this.numberFreeShipPerPage = response.data.numberFreeShipPerPage;
            var length = Object.keys(response.data.data).length;

            var offset = this.numberFreeShipPerPage * (this.page -1);
            this.from = offset + 1;
            if(length === 0){
                this.from = offset ;
            }                  
            this.to = offset + length;
        },

        numberFormat(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

    }
}
</script>

<style >

/* ul.paginate-links > li.disabled > a {
    color: red;
}
ul.paginate-links > li.number > a {
    color: blue;
} */
.control-label {
    margin-right: 10px; font-weight: 100;
}
#vue-pagination {
    margin-top: -40px;
    margin-bottom: 0;
}
</style>