<template>
    <div>
        <div class="print-area">

            <div class="has-text-weight-bold has-text-centered is-size-5">
                CLASS LIST
            </div>
            <div class="has-text-weight-bold has-text-centered mb-4 is-size-6" v-if="academicYear">
                {{ academicYear.academic_year_code }} - {{ academicYear.academic_year_desc }}
            </div>

          
         
            <div class="mt-5" v-for="(item, index) in classLists" :key="index">
                
                <div v-if="item.enrollees.length > 0">
                     <div class="has-text-centered has-text-weight-bold">
                       {{ item.grade_level }} - {{ item.section }}
                    </div>
                    <!--div class="mb-4 has-text-centered">
                        {{ item.academic_year[0].academic_year_code }}
                        -
                        {{ item.academic_year[0].academic_year_desc  }}
                    </div>  -->
                </div>

                
                
                <div v-if="item.enrollees.length > 0">
                    
                    <div class="columns">
                        
                        <div class="column">
                            <div class="has-text-weight-bold">MALE</div>
                            <div v-for="(enroll, index) in item.enrollees" :key="`$enrolleesMale${index}`">
                                <div v-if="enroll.learner.sex === 'MALE'">
                                    {{ enroll.learner.lname }},  {{ enroll.learner.fname }} {{ enroll.learner.mname }}
                                </div>
                            </div>
                        </div>

                        <div class="column">
                            <div class="has-text-weight-bold">FEMALE</div>
                            <div v-for="(enroll, index) in item.enrollees" :key="`$enrolleesFemale${index}`">
                                <div v-if="enroll.learner.sex === 'FEMALE'">
                                    {{ enroll.learner.lname }},  {{ enroll.learner.fname }} {{ enroll.learner.mname }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div v-if="item.enrollees.length > 0" class="has-text-centered">
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
        loadReportLearner(){
            axios.get('/get-report-class-list').then(res=>{
                this.classLists = res.data
            })
        },

        loadActiveAcademicYear(){
            axios.get('/load-academic-year').then(res=>{
                this.academicYear = res.data
            })
   
        }
    },

    mounted(){
        this.loadActiveAcademicYear()
        this.loadReportLearner()
    }
}
</script>