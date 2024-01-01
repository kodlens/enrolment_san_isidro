<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop">
                    <div class="box">
                        <div class="has-text-weight-bold subtitle is-4">GRADE LEVEL SUBJECTS</div>
                        
                        
                        
                        <div class="columns">
                            <div class="column">
                                <b-field label="Grade Level"
                                    expanded>
                                    <b-select
                                        expanded
                                        icon="account"
                                        placeholder="Grade Level"
                                        v-model="search.grade"
                                        @input="loadAsyncData"
                                        required>
                                        <option value="">ALL</option>
                                        <option :value="item.grade_level"
                                                v-for="(item, ix) in gradeLevels" :key="`g${ix}`">
                                            {{ item.grade_level }}
                                        </option>
                                    </b-select >
                                </b-field>
                            </div> <!--col--> 

                            <div class="column">
                                <b-field label="Search">
                                    <b-input type="text"
                                    v-model="search.subject" placeholder="Search Subject"
                                    @keyup.native.enter="loadAsyncData"/>
                                    <p class="control">
                                        <b-tooltip label="Search" type="is-success">
                                            <b-button type="is-primary" icon-right="account-filter" @click="loadAsyncData"/>
                                        </b-tooltip>
                                    </p>
                                </b-field>
                            </div>
                        </div> <!--cols-->
                        
                        



                        <div class="buttons is-right mt-3">
                            <b-button tag="a"
                                href="/grade-level-subjects/create"
                                icon-left="plus" 
                                class="is-primary is-small">NEW</b-button>
                        </div>

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

                            <b-table-column field="grade_level_subject_id" label="ID" sortable v-slot="props">
                                {{ props.row.grade_level_subject_id }}
                            </b-table-column>

                            <b-table-column field="grade_level" label="Grade Level" v-slot="props">
                                {{ props.row.grade_level }}
                            </b-table-column>

                            <b-table-column field="subject" sortable label="Subject" v-slot="props">
                                <span v-if="props.row.subject">
                                    {{ props.row.subject.subject_code }}
                                </span>
                            </b-table-column>

                            <b-table-column field="subjec_description" label="Description" v-slot="props">
                                <span v-if="props.row.subject">
                                    {{ props.row.subject.subject_description }}
                                </span>
                            </b-table-column>
                            
                            <b-table-column field="semester" label="Semester" v-slot="props">
                                <span v-if="props.row.semester">
                                    {{ props.row.semester.semester }}
                                </span>
                            </b-table-column>
                        
                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                 
                                    <b-tooltip label="Delete" type="is-danger">
                                        <b-button class="button is-small mr-1" icon-right="delete" @click="confirmDelete(props.row.grade_level_subject_id)"></b-button>
                                    </b-tooltip>

                                </div>
                            </b-table-column>
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
            sortField: 'grade_level_subject_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',

            global_id : 0,

            search: {
                subject: '',
                grade: ''
            },

            gradeLevels: [],

        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `subject=${this.search.subject}`,
                `grade=${this.search.grade}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-grade-level-subjects?${params}`)
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
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this section?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/grade-level-subjects/' + delete_id).then(res => {
                this.loadAsyncData();
                this.clearFields()
            })
        },

        clearFields(){
            this.global_id = 0;
            this.fields.section = null
        },

        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data
            })
        }

    },

    mounted() {
        this.loadAsyncData()
        this.loadGradeLevels()
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
