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

           
           


            <table class="table is-narrow" style="margin: auto;">
                <tr>
                    <th>#</th>
                    <th>GRADE LEVEL</th>
                    <th>SECTION</th>
                    <th>TRACK/STRAND</th>
                    <th>SUBJECT CODE</th>
                    <th>SUBJECT DESCRIPTION</th>
                    <th>TEACHER</th>
                </tr>
                <tr v-for="(item, index) in classLists" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>
                        {{ item.grade_level }}
                    </td>
                    <td>
                        {{ item.section }}
                    </td>
                    <td>
                        <span v-if="item.track">
                            {{ item.track }}
                        </span>
                        <span v-else>N/A</span>
                    </td>
                    <td>
                        {{ item.subject_code }}
                    </td>
                    <td>
                        {{ item.subject_description }}
                    </td>
                    <td>
                        <span v-if="item.teacher_id">
                            {{ item.lname }}, {{ item.fname }} {{ item.mname }}
                        </span>
                        
                    </td>
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

            classLists: [],
            academicYear: {},
        }
    },

    methods: {
        loadReportLearner(){
            console.log(this.academicYear);
            axios.get('/get-report-class-list-by-subject?ayid=' + this.academicYear.academic_year_id).then(res=>{
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
</style>