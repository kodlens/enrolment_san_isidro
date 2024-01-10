<template>
    <div>

        <div class="filter">

            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="columns">
                        <!-- <div class="column">
                            <b-field label="Academic Year" expanded>
                                <b-select v-model="search.academicYears"
                                    expanded>
                                    <option :value="item.academic_year_id" v-for="(item, index) in gradeLevels" :key="`acad${index}`">
                                        {{ item.academic_year_code }} ({{ item.academic_year_desc }})
                                    </option>
                                </b-select>
                            </b-field>
                        </div> -->

                        <div class="column">
                            <b-field label="Grade Level" expanded>
                                <b-select v-model="search.grade_level"
                                    expanded
                                    @input="loadSections">
                                    <option :value="item.grade_level" v-for="(item, index) in gradeLevels" :key="`grade${index}`">
                                        {{ item.grade_level }}
                                    </option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Section"
                                expanded>
                                <b-select
                                    expanded
                                    icon="account"
                                    placeholder="Section"
                                    v-model="search.section_id">
                                    <option :value="item.section_id"
                                            v-for="(item, ix) in sections" :key="`section${ix}`">
                                        {{ item.section }}
                                    </option>
                                </b-select >
                                <p class="controls">
                                    <b-button 
                                        @click="loadReportLearner" 
                                        class="is-primary"
                                        icon-right="magnify"></b-button>
                                </p>
                            </b-field>
                          
                        </div>
                    </div>
                </div>
                
            </div>

            

        </div>
        <div class="p-area">

            <div class="header">
                <div>
                    <img src="/img/tudela_logo.png" class="header-img" />
                </div>
                
                <div>
                    <div class="has-text-weight-bold has-text-centered is-size-5">
                        School Form 1 (SF 1) School Registrar
                    </div>
                    <!-- <div class="has-text-weight-bold has-text-centered mb-4 is-size-6" v-if="academicYear">
                        
                    </div> -->

                    <div style="font-size: 12px;">
                        <span><b>SCHOOL NAME: </b> SAN ISIDRO ACADEMY OF TUDELA, INC.</span>
                        <span class="ml-4"><b>SCHOOL YEAR:</b> {{ academicYear.academic_year_code }} - {{ academicYear.academic_year_desc }}</span>
                        <span class="ml-4"><b>SECTION:</b> <span v-if="enrollees[0]">{{ enrollees[0].section.section }}</span></span>

                        <!-- <span>Grade Level: {{ enrollees }}</span> -->

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

            academicYears: [],
            gradeLevels: [],
            sections: [],


            search: {
                grade_level: '',
                section_id: null
            },
        }
    },

    methods: {
        loadReportLearner(){
            
            const params = [
                `academic=${this.academicYear.academic_year_id}`,
                `grade=${this.search.grade_level}`,
                `section=${this.search.section_id}`
            ].join('&')

            axios.get(`/get-report-enrolment-list?${params}`).then(res=>{
                this.enrollees = res.data
            })
        },

        async loadActiveAcademicYear(){
            await axios.get('/load-academic-year').then(res=>{
                this.academicYear = res.data
            })
   
        },

        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data
            })
        },
        loadSections(){
            axios.get('/load-section?grade=' + this.search.grade_level).then(res=>{
                this.sections = res.data;
            })
        },
        

    },

    mounted(){

        this.loadGradeLevels()

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

.filter{
    margin: 20px 0;
}

@media print{
    @page {size: landscape}
    
    .filter{
        display: none;
    }
}
</style>