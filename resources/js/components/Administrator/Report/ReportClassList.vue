<template>
    <div>
        <div class="print-area">

            <div class="has-text-weight-bold has-text-centered is-size-5">
                CLASS LIST
            </div>
            <div class="has-text-weight-bold has-text-centered mb-4 is-size-6" v-if="academicYear">
                {{ academicYear.academic_year_code }} - {{ academicYear.academic_year_desc }}
            </div>

          
         
            <div class="mt-5 box" v-for="(item, index) in classLists" :key="index">
                
                <div v-if="item.students" class="mb-2">
                    <div class="has-text-weight-bold">
                       SUBJECT: {{ item.subject_code }} ({{ item.subject_description }})
                    </div>
                    <div class="has-text-weight-bold">
                       GRADE LEVEL / SECTION: {{ item.grade_level }} - {{ item.section }}
                    </div>
                    <div class="has-text-weight-bold" v-if="item.track">
                       TRACK / STRAND: {{ item.track }} - {{ item.strand }}
                    </div>
                    <!--div class="mb-4 has-text-centered">
                        {{ item.academic_year[0].academic_year_code }}
                        -
                        {{ item.academic_year[0].academic_year_desc  }}
                    </div>  -->
                </div>

                
                
                <div v-if="item.students">
                    
                    <div class="columns">
                        
                        <div class="column">
                            <div class="has-text-weight-bold">MALE</div>
                            <div v-for="(student, index) in item.students" :key="`$enrolleesMale${index}`">
                                <div v-if="student.sex === 'MALE'">
                                    {{ student.lname }},  {{ student.fname }} {{ student.mname }}
                                </div>
                            </div>
                        </div>

                        <div class="column">
                            <div class="has-text-weight-bold">FEMALE</div>
                            <div v-for="(student, index) in item.students" :key="`$enrolleesFemale${index}`">
                                <div v-if="student.sex === 'FEMALE'">
                                    {{ student.lname }},  {{ student.fname }} {{ student.mname }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div v-if="item.students" class="has-text-centered">
                    <hr>
                    **END SECTION**
                </div>
            </div><!--loop-->

        </div>
    </div>
</template>

<script>

export default{
    props:{
        propAcademicYearId: {
            type: Number,
            default: 0
        },
        propLearnerId: {
            type: Number,
            default: 0
        }
    },
    
    data(){
        return {
            learner: {},

            classLists: [],
            academicYear: {},
        }
    },

    methods: {
        // loadReportLearner(){
        //     axios.get('/get-report-class-list').then(res=>{
        //         this.classLists = res.data
        //     })
        // },
        loadReportLearner(){
            console.log(this.academicYear);
            axios.get('/get-report-class-list-by-subject-teacher?ayid=' + this.academicYear.academic_year_id).then(res=>{
                this.classLists = res.data
            })
        },

        async loadActiveAcademicYear(){
            await axios.get('/load-academic-year').then(res=>{
                this.academicYear = res.data
            })
   
        }
    },

    mounted(){
        this.loadActiveAcademicYear().then(()=>{
            this.loadReportLearner()
        })
    }
}
</script>