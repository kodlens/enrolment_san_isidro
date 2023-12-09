<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-dekstop is-10-tablet">
                    <div class="box">

                        <div class="has-text-weight-bold is-size-4">ENROLLEES</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            List of enrollees of the selected Academic Year.
                        </div>

                        <b-field label="Academic Year">
                            <b-select v-model="search.ayid" 
                                placeholder="Academic Year"
                                @keyup.native.enter="loadAsyncData">
                                <option v-for="(item, ix) in academicYears" :key="`ay${ix}`" 
                                    :value="item.academic_year_id">
                                    {{ item.academic_year_code }} - {{ item.academic_year_desc }}
                                </option>
                            </b-select>
                                
               
                        </b-field>


                        <b-field label="Search">
                            <b-input type="text"
                                     v-model="search.name" placeholder="Search Lastname"
                                     @keyup.native.enter="loadAsyncData"/>
                            <p class="control">
                                <b-tooltip label="Search" type="is-success">
                                    <b-button type="is-primary" icon-right="account-filter" @click="loadAsyncData"/>
                                </b-tooltip>
                            </p>
                        </b-field>

                        <!-- <div class="buttons is-right mt-3">
                            <b-button tag="a" href="/enrollee/create"
                                  icon-left="plus"
                                  class="is-primary is-small">ADD LEARNER</b-button>
                        </div> -->

                        <b-table
                            :data="data"
                            :loading="loading"
                            paginated
                            detailed
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


                            <b-table-column field="lname" label="Name" sortable v-slot="props">
                                {{ props.row.learner.lname }}, {{ props.row.learner.fname }} {{ props.row.learner.mname }}
                            </b-table-column>

                            <b-table-column field="sex" label="Sex" v-slot="props">
                                {{ props.row.learner.sex }}
                            </b-table-column>

                            <b-table-column field="grade_level" label="Grade Level" v-slot="props">
                                {{ props.row.grade_level }}
                            </b-table-column>

                            <b-table-column field="grade_level" label="Enrollment Status" v-slot="props">
                                <span v-if="props.row.is_enrolled == 1">ENROLED</span>
                                <span v-else>ADMITTED</span>

                            </b-table-column>

                            <b-table-column field="track_strand" label="Track/Strand" v-slot="props">
                                <span v-if="props.row.track">
                                    {{ props.row.track.track }}
                                </span>

                                <span v-if="props.row.strand">
                                    / {{ props.row.strand.strand }}

                                </span>

                            </b-table-column>

                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                    <b-tooltip label="Payment History" type="is-warning">
                                        <b-button class="button is-small mr-1" 
                                            tag="a" icon-right="history" 
                                            @click="getData(props.row.billing_id)"></b-button>
                                    </b-tooltip>
                                    <b-tooltip label="Delete" type="is-danger">
                                        <b-button class="button is-small mr-1" 
                                            icon-right="delete" 
                                            @click="confirmDelete(props.row.enroll_id)"></b-button>
                                    </b-tooltip>

                                    <b-tooltip label="More options">
                                        <b-dropdown aria-role="list">
                                            <template #trigger="{ active }">
                                                <b-button
                                                    label=""
                                                    size="is-small"
                                                    type="is-primary"
                                                    :icon-right="active ? 'menu-up' : 'menu-down'" />
                                            </template>

                                            <b-dropdown-item aria-role="listitem">Action</b-dropdown-item>
                                            <b-dropdown-item aria-role="listitem">Another action</b-dropdown-item>
                                            <b-dropdown-item aria-role="listitem">Something else</b-dropdown-item>
                                        </b-dropdown>
                                    </b-tooltip>
                                </div>
                            </b-table-column>

                            <template #detail="props">
                                <p class="has-text-weight-bold is-size-6">SUBJECTS</p>
                                <table class="table">
                                    <tr>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Class</th>
                                        <th>Fee</th>
                                    </tr>
                                    <tr v-for="(item, ix) in props.row.subjects" :key="`subj${ix}`">
                                        <td>{{ item.subject.subject_code }}</td>
                                        <td>{{ item.subject.subject_description }}</td>
                                        <td>{{ item.subject.class }}</td>
                                        <td>{{ item.subject.fee }}</td>
                                    </tr>
                                </table>

                                <div class="buttons">
                                    <b-button tag="a" 
                                        :href="`/print-coe/${props.row.learner_id}/${search.ayid}`"
                                        class="is-small is-outlined is-info mt-2"
                                        icon-left="printer">PRINT COE</b-button>
                                </div>
                            </template>
                        </b-table>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Page" label-position="on-border">
                                    <b-select v-model="perPage" @input="setPerPage" class="is-small">
                                        <option value="5">5 per page</option>
                                        <option value="10">10 per page</option>
                                        <option value="15">15 per page</option>
                                        <option value="20">20 per page</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->





    </div>
</template>

<script>

export default{

    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'enroll_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',

            global_id : 0,

            search: {
                ayid: '',
                name: '',
            },

            isModalCreate: false,
     
            errors: {},

            academicYears: [],
        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `name=${this.search.name}`,
                `ayid=${this.search.ayid}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-enrollees?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
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


        //alert box ask for deletion
        confirmDelete(dataId) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(dataId)
            });
        },
        //execute delete after confirming
        deleteSubmit(dataId) {
            axios.delete('/enrollee/' + dataId).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        //update code here
        getData: function(data_id){
            window.location = '/manage-learners/' + data_id + '/edit'
        },


        async loadAcademicYears(){
            await axios.get('/load-academic-years').then(res=>{
                this.academicYears = res.data

                this.academicYears.forEach(item =>{
                    if(item.is_active === 1){
                        this.search.ayid = item.academic_year_id
                    }
                })
            }).catch(err=>{
            
            })
        }


    },

    mounted() {
        this.loadAcademicYears().then(()=>{
            this.loadAsyncData()
        })
  
    }

}


</script>


<style scoped>

.table > tbody > tr {
    /* background-color: blue; */
    transition: background-color 0.5s ease;
}

.table > tbody > tr:hover {
    background-color: rgb(233, 233, 233);

}

</style>
