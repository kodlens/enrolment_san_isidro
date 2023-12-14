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
                <div v-if="item.enroll">
                    <div class="has-text-centered has-text-weight-bold">
                        {{ item.grade_level }} - {{ item.section }}
                    </div>
                    <div class="mb-4 has-text-centered">
                        {{ item.enroll.academic_year.academic_year_code }}
                        -
                        {{ item.enroll.academic_year.academic_year_desc  }}
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div class="has-text-weight-bold">MALE</div>
                            <div v-if="item.enroll.learner.sex === 'MALE'">
                                {{ item.enroll.learner.lname }},  {{ item.enroll.learner.fname }} {{ item.enroll.learner.fname }} 
                            </div>
                        </div>
                        <div class="column">
                            <div class="has-text-weight-bold">FEMALE</div>
                            <div v-if="item.enroll.learner.sex === 'FEMALE'">
                                {{ item.enroll.learner.lname }},  {{ item.enroll.learner.fname }} {{ item.enroll.learner.fname }} 
                            </div>
                        </div>
                    </div>
                    <div class="has-text-centered">**END SECTION**</div>
                    <hr>
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