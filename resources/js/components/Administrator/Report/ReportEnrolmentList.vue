<template>
    <div>
        <div class="p-area">

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


            <table class="enrolment-table" border="1">
                <tr>
                    <th rowspan="2">LRN</th>
                    <th rowspan="2">NAME</th>
                    <th rowspan="2">SEX</th>
                    <th rowspan="2">BIRTHDATE</th>
                    <th rowspan="2">AGE</th>
                    <!-- <th rowspan="2">MOTHER TONGUE</th>
                    <th rowspan="2">IP</th> -->
                    <th rowspan="2">RELIGION</th>
                    <th colspan="4">ADDRESS</th>
                    <th colspan="2">PARENTS</th>
                    <th colspan="2">GUARDIAN</th>
                    <th rowspan="2">Contact Number</th>
                    <th>Remarks</th>
                
                </tr>

                <tr>
                    
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
                    <td>{{ item.learner.sex }}</td>
                    <td>{{ item.learner.birthdate }}</td>
                    <td>{{ item.learner.age }}</td>

                   <td>{{ item.learner.religion }}</td>
                   
                   <td>{{ item.learner.street }}</td>
                   <td>{{ item.learner.barangay.brgyDesc }}</td>
                   <td>{{ item.learner.city.citymunDesc }}</td>
                   <td>{{ item.learner.province.provDesc }}</td>
                   
                   <td>
                    <span v-if="item.learner.father_lname">
                        {{ item.learner.father_lname }}, {{ item.learner.father_fname }} {{ item.learner.father_mname }}
                    </span>
                </td>
                   <td>
                        <span v-if="item.learner.father_lname">
                            {{ item.learner.mother_maiden_lname }}, {{ item.learner.mother_maiden_fname }} {{ item.learner.mother_maiden_mname }}
                        </span>
                   </td>

                   <td>{{ item.learner.guardian_lname }}, {{ item.learner.guardian_fname }} {{ item.learner.guardian_mname }}</td>
                   <td></td>
                   <td>{{ item.learner.contact_no }}</td>
                   <td></td>
                </tr>
            </table>
       
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
.enrolment-table > tr > td{
    padding: 0 15px;
    font-size: 10px;
}

@media print{@page {size: landscape}}
</style>