<template>
    <div>
        <div class="print-area">

            <div class="header">
                <div>
                    <img src="/img/tudela_logo.png" class="header-img" />
                </div>
                <div>
                    <div class="has-text-weight-bold has-text-centered is-size-5">
                        School Form 1 (SF 1) School Registrar
                    </div>
                    <div class="has-text-weight-bold has-text-centered mb-4 is-size-6" v-if="academicYear">
                        {{ academicYear.academic_year_code }} - {{ academicYear.academic_year_desc }}
                    </div>
                </div>
               
                
            </div>


            <table class="enrolment-table" border="1" style="margin: auto;">
                <tr>
                    <th>LRN</th>
                    <th>NAME</th>
                    <th>SEX</th>
                    <th>BIRTHDATE</th>
                    <th>AGE</th>
                    <th>MOTHER TONGUE</th>
                    <th>IP</th>
                    <th>RELIGION</th>
                    <th colspan="4">ADDRESS</th>
                    <th colspan="2">PARENTS</th>
                    <th colspan="2">GUARDIAN</th>
                    <th rowspan="2">Contact Number</th>
                    <th>Remarks</th>
                
                </tr>

                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>House St. Purok</th>
                    <th>Barangay</th>
                    <th>Municipality/City</th>
                    <th>Province</th>
                    <th>Father's Name</th>
                    <th>Mother Maiden Name</th>
                    <th>Name</th>
                    <th>Relationship</th>

                </tr>

                <tr v-for="(item, index) in enrollees" :key="index">
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

            enrollees: [],
            academicYear: {},
        }
    },

    methods: {
        loadReportLearner(){
            console.log(this.academicYear);
            axios.get('/get-report-enrolment-list?ayid=' + this.academicYear.academic_year_id).then(res=>{
                this.enrollees = res.data
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

.enrolment-table > tr > th {
    text-align: center;
    font-size: 10px;
}
</style>