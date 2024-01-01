<template>

    <div>

        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">
                        <div class="has-text-weight-bold is-size-4">PAYMENT HISTORY</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            History of payment and transactions.
                        </div>


                        <div>
                            <p class="has-text-weight-bold is-size-4">BALANCE: {{ propData.fee_balance }}</p>
                        </div>

                        <div>
                            <p class="has-text-weight-bold is-size-5">Name: {{ propData.learner.lname }}, {{ propData.learner.fname }}
                                {{ propData.learner.mname }}
                            </p>
                        </div>

                        <div>
                            <b-table
                                :data="data"
                                :loading="loading"
                                paginated
                                backend-pagination
                                :total="total"
                                :pagination-rounded="true"
                                :per-page="perPage"
                                @page-change="onPageChange"
                                aria-next-label="Next page"
                                aria-previous-label="Previous page"
                                aria-page-label="Page"
                                aria-current-label="Current page"
                                backend-sorting
                                :default-sort-direction="defaultSortDirection"
                                @sort="onSort">

                                <b-table-column field="billing_payment_id" label="ID" v-slot="props">
                                    {{ props.row.billing_payment_id }}
                                </b-table-column>

                                <b-table-column field="date_paid" label="Date Paid" v-slot="props">
                                    {{ props.row.date_paid }}
                                </b-table-column>

                                <b-table-column field="current_balance" label="Current Balance" v-slot="props">
                                    {{ props.row.current_balance }}
                                </b-table-column>

                                <b-table-column field="payment" label="Payment" v-slot="props">
                                    {{ props.row.payment }}
                                </b-table-column>

                            </b-table>

                            <div class="mt-4"></div>
                        </div>
                 
                       
                    </div> <!--panel-->
                </div> <!--col--> 
            </div> <!--cols-->
        </div>

    </div>
</template>

<script>

export default{
    props: {
        propId: {
            type: Number,
            default: 0
        },
        propData: {
            type: Object,
            default: {}
        }
    },

    
    data(){
        return {

            data: [],
            total: 0,
            loading: false,
            sortField: 'billing_payment_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',
            finalTotalFee: 0,

            errors: {},

        }
        
    },

    methods: {
         /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
               
                `learner=${this.propId}`,
                
            ].join('&')

            this.loading = true
            axios.get(`/get-payment-history?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }
            
                    this.total = currentTotal
                    data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },

        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },

        setPerPage(){
            this.loadAsyncData()
        },
      

    },

    

    mounted(){
        this.loadAsyncData()
    },


    computed: {
        totalFee(){
            let total = 0
            this.enrollee.subjects.forEach(item => {
                total += Number(item.subject.fee)
            });

            let oFees = 0
            this.otherFees.forEach(item =>{
                oFees += item.amount
            })
            
            this.finalTotalFee = total + oFees
            return total
        }
    }
}
</script>

<style scoped>

.info-header{
    background-color: green;
    padding: 10px;
    color: white;
}
.subject-card{
    margin: 10px 0px 5px 0px;
    border: 1px solid gray;
    padding: 15px;
}
</style>