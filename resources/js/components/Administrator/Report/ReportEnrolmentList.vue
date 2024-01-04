<template>
    <div>
        <div class="print-area">

            <div class="header">
                <div>
                    <img src="/img/tudela_logo.png" class="header-img" />
                </div>
                <div>
                    <div class="has-text-weight-bold has-text-centered is-size-5">
                        CLASS LIST
                    </div>
                    <div class="has-text-weight-bold has-text-centered mb-4 is-size-6" v-if="academicYear">
                        {{ academicYear.academic_year_code }} - {{ academicYear.academic_year_desc }}
                    </div>
                </div>
               
                
            </div>


            <table class="enrolment-table" style="margin: auto;">
                <tr>
                    <th>LRN</th>
                    <th>NAME</th>
                    <th>SEX</th>
                    <th>GRADE LEVEL</th>
                    <th>SECTION</th>
                    <th>TRACK/STRAND</th>
                </tr>
                <tr v-for="(item, index) in classLists" :key="index">
                    <td>{{ item.learner.lrn }}</td>
                    <td>
                        {{ item.learner.lname }}, {{ item.learner.fname }} {{ item.learner.mname }}
                    </td>
                    <td>
                        {{ item.learner.sex }}
                    </td>
                    <td>
                        {{ item.grade_level }}
                    </td>
                   
                   
                    <td>
                        {{ item.section.section }}
                    </td>
                    <td>
                        <span v-if="item.learner.track">
                            {{ item.learner.track.track }}
                        </span>
                        <span v-else>N/A</span>
                    </td>
                   
                </tr>
            </table>
       

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
            console.log(this.academicYear);
            axios.get('/get-report-enrolment-list?ayid=' + this.academicYear.academic_year_id).then(res=>{
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

<style scoped>

.header{
    display: flex;
    justify-content: center;
    align-items: center;
}
.header-img{
    height: 60px;
}


.enrolment-table{
    border: 1px solid gray;
    font-size: 12px;
}
</style>