<template>
    <div>
        <div class="print-area">

            <div class="has-text-weight-bold has-text-centered is-size-5">
                CERTIFICATE OF ENROLEMENT
            </div>
            <div class="has-text-weight-bold has-text-centered mb-4 is-size-6" v-if="learner.academic_year">
                {{ learner.academic_year.academic_year_code }} - {{ learner.academic_year.academic_year_desc }}
            </div>

            <table class="report-learner-info">
                <tr>
                    <td> NAME: </td>
                    <td class="report-data">
                        <span v-if="learner.learner">
                            {{ learner.learner.lname }}, {{ learner.learner.fname }} {{ learner.learner.mname }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td> GRADE LEVEL: </td>
                    <td class="report-data">
                        <span v-if="learner.learner">
                            {{ learner.learner.grade_level }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td> TRACK & STRAND: </td>
                    <td class="report-data">
                        <span v-if="learner.track">
                            {{ learner.track.track }} - {{ learner.strand.strand }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td> BALANCE: </td>
                    <td class="report-data">
                        <span v-if="learner.billing">
                            {{ learner.billing.fee_balance }}
                        </span>
                    </td>
                </tr>
            </table>
            <div class="mt-4 has-text-weight-bold">SUBJECTS</div>
            <table class="report-subject-table">
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Time</th>
                        <th>Day</th>
                        <th>Instructor</th>
                    </tr>
                    <tr v-for="(item, index) in learner.subjects" :key="`sub${index}`">
                        <td>{{ item.subject.subject_code }}</td>
                        <td>{{ item.subject.subject_description }}</td>
                        <td>____________________</td>
                        <td>____________________</td>
                        <td>____________________</td>
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
        }
    },

    methods: {
        loadReportLearner(){
            axios.get('/get-report-learner/' + this.propLearnerId + '/' + this.propAcademicYearId).then(res=>{
                this.learner = res.data
            })
        }
    },

    mounted(){
        this.loadReportLearner()
    }
}
</script>