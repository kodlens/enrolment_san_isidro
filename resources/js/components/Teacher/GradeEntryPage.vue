<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop">
                    <div class="box">
                        <div class="has-text-weight-bold subtitle is-4">MY STUDENTS</div>
                        <div class="has-text-weight-bold is-4" v-if="data[0]">
                            Grade Level: {{ data[0].grade_level }}
                        </div>
                        <div class="has-text-weight-bold is-4" v-if="data[0]">
                            Section: {{ data[0].section }}
                        </div>
                        
    
                        <table class="table is-fullwidth">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>1st Grading</th>
                            </tr>
                            <tr v-for="(item, index) in data" :key="`student${index}`">
                                <td>{{ item.enroll_subject_id }}</td>
                                <td>{{ item.lname }}, {{ item.fname }} {{ item.mname }}</td>
                                <td><b-input type="text" size="is-small" v-model="item.grade"></b-input></td>
                            </tr>
                        </table>

                        <div class="buttons">
                            <b-button type="is-primary" 
                                icon-left="content-save" 
                                label="Save Grade"
                                @click="submit"></b-button>
                        </div>
                        
                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->





    </div>
</template>

<script>

export default{
    props: {
        propAcademicYearId: {
            type:Number,
            default: 0
        },
        propSectionId: {
            type:Number,
            default: 0
        },
        propEnrollId: {
            type:Number,
            default: 0
        },
        propSubjectId: {
            type:Number,
            default: 0
        }
    },
 

    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'enroll_subject_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 10,
            defaultSortDirection: 'asc',

            global_id : 0,

            search: {
                academic_year_id: null,
            },

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
                `academic=${this.propAcademicYearId}`,
                `section=${this.propSectionId}`,
                `subject=${this.propSubjectId}`,
                `enroll=${this.propEnrollId}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-my-learners?${params}`)
                .then(res=>{
                    this.data = res.data
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
       

  

        async loadAcademicYears(){
            await axios.get('/load-academic-years').then(res=>{
                this.academicYears = res.data

                this.academicYears.forEach(item =>{
                    if(item.is_active === 1){
                        this.search.academic_year_id = item.academic_year_id
                    }
                })
            })
          
        },

        gradeEntry(row){
            console.log(row);
            window.location = '/grade-entry?section=' + row.section_id + '&enroll=' + row.enroll_id + '&subject=' + row.subject_id
        },

        submit(){
            axios.post('/save-grade', this.data).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'SAVED!',
                        message: 'Grade updated.',
                        type: 'is-success',
                        onConfirm: () => {
                            this.loadAsyncData();
                           
                        }
                    })
                }
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
