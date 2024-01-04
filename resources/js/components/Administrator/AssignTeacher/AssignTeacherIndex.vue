<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-dekstop is-10-tablet">
                    <div class="box">

                        <div class="has-text-weight-bold is-size-4">ASSIGN TEACHER</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            List of subjects of the selected Academic Year.
                        </div>


                        <div class="columns">
                            <div class="column">
                                <b-field label="Academic Year" expanded>
                                    <b-select v-model="search.ayid" 
                                        expanded
                                        placeholder="Academic Year"
                                        @keyup.native.enter="loadAsyncData">
                                        <option v-for="(item, ix) in academicYears" :key="`ay${ix}`" 
                                            :value="item.academic_year_id">
                                            {{ item.academic_year_code }} - {{ item.academic_year_desc }}
                                        </option>
                                    </b-select>
                                        
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Grade Level" expanded>
                                    <b-select v-model="search.grade_level" 
                                        expanded
                                        @input="loadSemesters"
                                        placeholder="Grade Level">
                                        <option :value="{ grade_level: '', curriculum_code: ''}">ALL</option>
                                        <option v-for="(item, ix) in gradeLevels" :key="`grade${ix}`" 
                                            :value="{ grade_level: item.grade_level, curriculum_code: item.curriculum_code }">
                                            {{ item.grade_level }} ({{ item.curriculum_code }})
                                        </option>
                                    </b-select>
                                </b-field>
                            </div>

                            <div class="column" v-if="search.grade_level.curriculum_code === 'SHS'">
                                <b-field label="Semester" expanded>
                                    <b-select v-model="search.semester" 
                                        expanded
                                        placeholder="Semester">
                                        <option v-for="(item, ix) in semesters" :key="`sem${ix}`" 
                                            :value="item.semester_id">
                                            {{ item.semester }}
                                        </option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <b-field label="Sections" expanded>
                                    <b-select v-model="search.sections" 
                                        expanded
                                        placeholder="Sections">
                                        <option v-for="(item, ix) in sections" :key="`section${ix}`" 
                                            :value="item.section_id">
                                            {{ item.section }}
                                        </option>
                                    </b-select>
                                </b-field>
                            </div>
                            <div class="column">
                                <b-field label="Search">
                                    <b-input type="text"
                                        v-model="search.subject" 
                                        placeholder="Search Subject"
                                        @keyup.native.enter="loadAsyncData"/>
                                </b-field>
                            </div>
                        </div>

                        <div class="buttons">
                            <b-button type="is-primary" 
                                icon-right="magnify" label="SEARCH" @click="loadAsyncData">
                            </b-button>
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


                            <b-table-column field="grade_level" label="Grade Level" v-slot="props">
                                {{ props.row.grade_level }}
                            </b-table-column>

                            <b-table-column field="section" label="Section" v-slot="props">
                                {{ props.row.section }}
                            </b-table-column>

                            <b-table-column field="subject" label="Subject Description" v-slot="props">
                                {{ props.row.subject_code }} - {{ props.row.subject_description }}
                            </b-table-column>

                            <!-- <b-table-column field="grade_level" label="Enrollment Status" v-slot="props">
                                <span class="enroled" v-if="props.row.is_enrolled == 1">ENROLED</span>
                                <span class="admitted" v-else>ADMITTED</span>

                            </b-table-column> -->

                            <b-table-column field="track_strand" label="Track/Strand" v-slot="props">
                                <span v-if="props.row.track">
                                    {{ props.row.track }}  / {{ props.row.strand }}
                                </span>

                                <span v-else>
                                   N/A
                                </span>

                            </b-table-column>

                            <!-- <b-table-column field="section" label="Grade Level" v-slot="props">
                                {{ props.row.section }}
                            </b-table-column> -->

                            <b-table-column field="teacher" label="Teacher" v-slot="props">
                                 <span v-if="props.row.lname">{{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}</span>
                            </b-table-column>

                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                    <b-tooltip label="Assign Faculty" type="is-warning">
                                        <b-button class="button is-small mr-1" icon-right="account" 
                                            @click="openModalTeacher(props.row)"></b-button>
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
                                        <option value="30">30 per page</option>
                                        <option value="40">40 per page</option>
                                        <option value="50">50 per page</option>
                                    </b-select>
                                </b-field>
                            </div>
                        </div>

                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->








        
        <b-modal v-model="modalTeacher" has-modal-card
                 trap-focus scroll="keep" aria-role="dialog" aria-modal>
            <div class="modal-card card-width">
                <header class="modal-card-head">
                    <p class="modal-card-title has-text-weight-bold is-size-6">SELECT TEACHER</p>
                    <button type="button" class="delete"
                        @click="modalTeacher = false"/>
                </header>

                <section class="modal-card-body">
                    <div>

                        <!-- <b-field label="Academic Year" label-position="on-border" expanded>
                            <b-select v-model="search.academic_year_id" 
                                expanded
                                placeholder="Select Academic Year"
                                @input="loadAsyncData">
                                <option v-for="(item, index) in academicYears"
                                    :key="index" 
                                    :value="item.academic_year_id">{{ item.academic_year_code }} - {{ item.academic_year_desc }}</option>
                            </b-select>
                        </b-field> -->

                 

                        <b-field label="Search" label-position="on-border" >
                            <b-input type="text" v-model="search.lname" placeholder="Search Lastname..." expanded auto-focus></b-input>
                            <b-input type="text" v-model="search.fname" placeholder="Search Firstname..." expanded auto-focus></b-input>
                            <p class="control">
                                <b-button class="is-primary" icon-left="magnify" @click="loadAsyncDataTeacher"></b-button>
                            </p>
                        </b-field>

                        <div class="table-container">
                            <b-table
                                :data="dataTeacher"
                                :loading="loadingTeacher"
                                paginated
                                backend-pagination
                                :total="totalTeacher"
                                :pagination-rounded="true"
                                :per-page="perPageTeacher"
                                @page-change="onPageChangeTeacher"
                                aria-next-label="Next page"
                                aria-previous-label="Previous page"
                                aria-page-label="Page"
                                aria-current-label="Current page"
                                backend-sorting
                                :default-sort-direction="defaultSortDirectionTeacher"
                                @sort="onSortTeacher">

                                <b-table-column field="user_id" label="Id" v-slot="props">
                                    {{props.row.user_id}}
                                </b-table-column>

                                <b-table-column field="lname" label="Lastname" v-slot="props">
                                    {{props.row.lname}}
                                </b-table-column>

                                <b-table-column field="fname" label="Firstname" v-slot="props">
                                    {{props.row.fname}}
                                </b-table-column>

                                <b-table-column field="mname" label="Middlename" v-slot="props">
                                    {{props.row.mname}}
                                </b-table-column>

                                <b-table-column field="" label="Action" v-slot="props">
                                    <div class="buttons">
                                        <b-button class="is-small is-rounded is-primary" 
                                            icon-left="arrow-right"
                                            @click="assignTeacher(props.row)">
                                            SELECT
                                        </b-button>
                                    </div>
                                </b-table-column>
                            </b-table>
                        </div>

                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="modalTeacher=false"></b-button>
                </footer>
            </div>
        </b-modal>





    </div>
</template>

<script>

export default{

    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'enroll_subject_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 30,
            defaultSortDirection: 'asc',

            //for teacher table and modal
            dataTeacher: [],
            totalTeacher: 0,
            loadingTeacher: false,
            sortFieldTeacher: 'user_id',
            sortOrderTeacher: 'desc',
            pageTeacher: 1,
            perPageTeacher: 10,
            defaultSortDirectionTeacher: 'asc',

            global_id : 0,

            search: {
                ayid: '',
                name: '',
                grade_level: {},
                semester: null
            },

            fields: {},
            errors: {},

            academicYears: [],
            gradeLevels: [],
            semesters: [],
            sections: [],


            modalTeacher: false,
            section_id: null,
            academic_year_id: null,
            subject_id: null,
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
                `grade=${this.search.grade_level.grade_level}`,
                `semester=${this.search.semester}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-enroll-section-subjects?${params}`)
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



        //for teacher load
        loadAsyncDataTeacher() {
            const params = [
                `sort_by=${this.sortFieldTeacher}.${this.sortOrderTeacher}`,
                `name=${this.search.teacher_name}`,
                `perpage=${this.perPageTeacher}`,
                `page=${this.pageTeacher}`
            ].join('&')

            this.loadingTeacher = true
            axios.get(`/load-teacher-lists?${params}`)
                .then(({ data }) => {
                    
                    this.dataTeacher = [];

                    let currentTotal = data.total

                    if (data.total / this.perPageTeacher > 1000) {
                        currentTotal = this.perPageTeacher * 1000
                    }

                    this.totalTeacher = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.dataTeacher.push(item)
                    })
                    this.loadingTeacher = false
                })
                .catch((error) => {
                    this.dataTeacher = []
                    this.totalTeacher = 0
                    this.loadingTeacher = false
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
        onPageChangeTeacher(page) {
            this.pageTeacher = page
            this.loadAsyncDataTeacher()
        },

        onSortTeacher(field, order) {
            this.sortFieldTeacher = field
            this.sortOrderTeacher = order
            this.loadAsyncDataTeacher()
        },

        setPerPageTeacher(){
            this.loadAsyncDataTeacher()
        },
        openModalTeacher(row){
            this.loadAsyncDataTeacher()
            console.log(row);
            this.academic_year_id = row.academic_year_id
            this.section_id = row.section_id
            this.subject_id = row.subject_id

            this.modalTeacher = true
        },

        assignTeacher(row){
            console.log(row);
            axios.post('/save-teacher', {
                'section_id': this.section_id,
                'academic_year_id': this.academic_year_id,
                'user_id': row.user_id,
                'subject_id': this.subject_id

            }).then(res=>{
                if(res.data.status === 'saved'){
                    this.loadAsyncData()
                    this.modalTeacher = false
                    this.section_id = null
                    this.academic_year_id = null
                    this.subject_id = null
                }
            })
        },

        //alert box ask for deletion
        // confirmDelete(dataId) {
        //     this.$buefy.dialog.confirm({
        //         title: 'DELETE!',
        //         type: 'is-danger',
        //         message: 'Are you sure you want to delete this data?',
        //         cancelText: 'Cancel',
        //         confirmText: 'Delete',
        //         onConfirm: () => this.deleteSubmit(dataId)
        //     });
        // },
        // //execute delete after confirming
        // deleteSubmit(dataId) {
        //     axios.delete('/enrollee/' + dataId).then(res => {
        //         this.loadAsyncData();
        //     }).catch(err => {
        //         if (err.response.status === 422) {
        //             this.errors = err.response.data.errors;
        //         }
        //     });
        // },

        // //update code here
        // getData: function(data_id){
        //     window.location = '/payment-history/' + data_id
        // },

    


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
        },

        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data

                this.search.grade_level.grade_level = ''
            })
        },

        loadSemesters(){

            if(this.search.grade_level.curriculum_code === 'SHS'){
                axios.get('/load-semesters').then(res=>{
                    this.semesters = res.data
                })
            }else{
                this.search.semester = null
            }

            this.loadSections()
        },

        loadSections(){
            axios.get('/load-section?grade=' + this.search.grade_level['grade_level']).then(res=>{
                this.sections = res.data
            })
        }

        

    },

    mounted() {
        this.loadAcademicYears().then(()=>{
            this.loadAsyncData()
            this.loadGradeLevels()
        })
  
    }

}


</script>


<style scoped>



.enroled{
    font-weight: bold;
    font-size: 12px;
    padding: 5px;
    border-radius: 5px;
    background-color: green;
    color: white;
}

.admitted{
    font-weight: bold;
    font-size: 12px;
    padding: 5px;
    border-radius: 5px;
    background-color: #2335a0;
    color: #ffffff;
}

</style>
