<template>

    <div>

        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">
                        <div class="has-text-weight-bold is-size-4">BILLING SUBJECTS</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            Bill the subjects, record total amount enrolled.
                        </div>
                        <div class="has-text-weight-bold mb-4 info-header">LEARNER INFORMATON</div>
                        
                        <div>
                            <div class="columns">
                                <div class="column">
                                    <b-field
                                        :type="this.errors.learner_id ? 'is-danger':''"
                                        :message="this.errors.learner_id ? this.errors.learner_id[0] : ''">
                                        <modal-browse-enrollee
                                            :prop-name="enrollee.name"
                                            @browseEnrollee="emitBrowseEnrollee"></modal-browse-enrollee>
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Date Process">
                                        <b-datepicker v-model="enrollee.date_enrolled" 
                                            placeholder="Date Enrolled"></b-datepicker>
                                    </b-field>
                                </div>
                            </div> 

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Grade Level"
                                        expanded
                                        :type="this.errors.grade_level ? 'is-danger':''"
                                        :message="this.errors.grade_level ? this.errors.grade_level[0] : ''" >
                                        <b-select
                                            expanded
                                            icon="account"
                                            placeholder="Grade Level"
                                            v-model="enrollee.grade_level"
                                            disabled>
                                            <option :value="{ grade_level: item.grade_level, curriculum_code: item.curriculum_code }"
                                                v-for="(item, ix) in gradeLevels" :key="`g${ix}`">
                                                {{ item.grade_level }}
                                            </option>
                                        </b-select >
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Section"
                                        expanded
                                        :type="this.errors.section_id ? 'is-danger':''"
                                        :message="this.errors.section_id ? this.errors.section_id[0] : ''" >
                                        <b-select
                                            disabled
                                            expanded
                                            icon="account"
                                            placeholder="Section"
                                            v-model="enrollee.section_id"
                                            required>
                                            <option :value="item.section_id"
                                                    v-for="(item, ix) in sections" :key="`section${ix}`">
                                                {{ item.section }}
                                            </option>
                                        </b-select >
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Learner Status"
                                            expanded
                                            :type="this.errors.learner_status ? 'is-danger':''"
                                            :message="this.errors.learner_status ? this.errors.learner_status[0] : ''">
                                        <b-select expanded
                                            disabled
                                            icon="account"
                                            placeholder="Learner Status"
                                            v-model="enrollee.learner_status">
                                            <option value="OLD">OLD</option>
                                            <option value="NEW">NEW</option>
                                            <option value="RETURNEE">RETURNEE</option>
                                            <option value="TRANSFEREE">TRANSFEREE</option>
                                        </b-select>
                                    </b-field>
                                </div>

                            </div>


                            <div v-if="enrollee.grade_level.curriculum_code === 'SHS'">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Semester" expanded
                                            :type="this.errors.semester_id ? 'is-danger':''"
                                            :message="this.errors.semester_id ? this.errors.semester_id[0] : ''">
                                            <b-select v-model="enrollee.semester_id" expanded
                                                disabled
                                                icon="account"
                                                placeholder="Semester">
                                                <option :value="item.semester_id" v-for="(item, ix) in semesters" :key="`sem${ix}`">
                                                    {{  item.semester }}
                                                </option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Track"
                                                :type="this.errors.track_id ? 'is-danger':''"
                                                :message="this.errors.track_id ? this.errors.track_id[0] : ''">
                                            <b-select v-model="enrollee.track_id" expanded
                                                    disabled
                                                    icon="account"
                                                    placeholder="Track"
                                                    @input="loadStrands">
                                                <option :value="item.track_id" v-for="(item, ix) in tracks" :key="`track${ix}`">
                                                    {{  item.track }}
                                                </option>
                                            </b-select>
                                        </b-field>
                                    </div>

                                    <div class="column">
                                        <b-field label="Strand"
                                                :type="this.errors.strand_id ? 'is-danger':''"
                                                :message="this.errors.strand_id ? this.errors.strand_id[0] : ''">
                                            <b-select v-model="enrollee.strand_id" expanded disabled
                                                    icon="account"
                                                    placeholder="Strand">
                                                <option :value="item.strand_id" v-for="(item, ix) in strands" :key="`strand${ix}`">
                                                    {{  item.strand }}
                                                </option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>
                            </div>
                            

                        </div>

                        <hr>

                        <div class="has-text-weight-bold mb-4 info-header">SUBJECTS ENROLLED</div>
                        <b-field
                            :type="this.errors.subjects ? 'is-danger':''"
                            :message="this.errors.subjects ? this.errors.subjects[0] : ''">
                        </b-field>
                        <!-- subjects loop -->


                        <div class="subject-card">
                            <div class="has-text-weight-bold">SUBJECTS</div>

                            <table class="table">
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Fee</th>
              
                                </tr>
                                <tr v-for="(item, index) in enrollee.section_subjects" :key="index">
                                    <td>{{  item.subject.subject_code }}</td>
                                    <td>{{  item.subject.subject_description }}</td>
                                    <td>{{  item.subject.fee }}</td>
                                </tr>
                            </table>
                          
                            <div v-for="(item, ix) in otherFees" :key="`other${ix}`">
                                <div>{{ item.description }} - {{ item.amount }}</div>
                            </div>
                            <div>TOTAL SUBJECT FEE: <span>{{ totalFee }}</span></div>
                           

                            <div class="has-text-weight-bold">TOTAL FEE: <span>{{ finalTotalFee }}</span></div>
                          
                        </div>
                  

                        <div class="has-text-weight-bold mb-4 info-header">CONTROLS/ACTION</div>

                        <div class="buttons mt-4 is-right">
                            <b-button class="is-primary has-text-weight-bold"
                                @click="submit"
                                label="SAVE BILLING" icon-right="arrow-right"></b-button>
                        </div>
                        
                    </div> <!--panel-->
                </div> <!--col--> 
            </div> <!--cols-->
        </div>

    </div>
</template>

<script>

export default{
    data(){
        return {

            enrollee: {
                name: null,
                learner_id: null,
                date_enrolled: new Date(),
                grade_level: {},

                learner_status: null,

                semester_id: null,
                track_id: null,
                strand_id: null,
                section_id: 0,
                section_subjects: [],
               
            },

            finalTotalFee: 0,

            errors: {},

            gradeLevels: [],
            semesters: [],
            tracks: [],
            strands: [],
            sections: [],

            otherFees: [],


        }

        
    },

    methods: {
        
        async emitBrowseEnrollee(row){
            console.log(row);
            this.enrollee.learner_id = row.learner.learner_id
            this.enrollee.enroll_id = row.enroll_id
            this.enrollee.academic_year_id = row.academic_year_id

            this.enrollee.name = row.learner.lname + ', ' + row.learner.fname + ' ' + row.learner.mname
    
            this.enrollee.grade_level = { grade_level: row.grade_level.grade_level, curriculum_code: row.grade_level.curriculum_code }
            this.enrollee.curriculum_code = row.grade_level.curriculum_code

            this.enrollee.learner_status = row.learner_status
            this.enrollee.semester_id = row.semester_id
            this.enrollee.track_id = row.track_id
            
            await this.loadSection()

            this.enrollee.section_id = row.section_id
         
            await this.loadStrands()
            this.enrollee.strand_id = row.strand_id
     

            this.enrollee.section_subjects = row.section_subjects
            console.log(row.section_subjects);
       
            //this.loadOtherFees()
        },

        loadOtherFees(){
            axios.get('/load-other-fees').then(res=>{
                this.otherFees = res.data
            })
        },

        submit(){
            this.errors = {}
            this.enrollee.fee_balance = this.finalTotalFee
            axios.post('/billing-subjects', this.enrollee).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: "Saved!",
                        message: 'Data successfully saved.',
                        type: 'is-success',
                        onConfirm: ()=>  window.location = '/billing-subjects'
                    });
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors

                    if(this.errors.exist){
                        this.$buefy.dialog.alert({
                            title: "Exist!",
                            message: this.errors.exist[0],
                            type: 'is-danger'
                        });
                    }
                }
            })
        },

    



        //mga init data
        loadSemesters(){
            axios.get('/load-semesters').then(res=>{
                this.semesters = res.data;
            })
        },
        loadTracks(){
            axios.get('/load-tracks').then(res=>{
                this.tracks = res.data;
            })
        },
        async loadStrands() {
            axios.get('/load-strands?trackid=' +  this.enrollee.track_id).then(res=>{
                this.strands = res.data;
            })
        },
        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data;
            })
        },
        loadSection(){
            axios.get('/load-section?grade=' + this.enrollee.grade_level.grade_level).then(res=>{
                this.sections = res.data;
            })
        },

    


        clearFields(){
            this.enrollee = {
                name: null,
                learner_id: null,
                date_admission: new Date(),
                grade_level: {},

                learner_status: null,

                semester_id: null,
                track_id: null,
                strand_id: null,
                section: 0,

                fee_balance: 0,
                subjects: []

            };

            this.otherFees = []

        },

    },

    

    mounted(){
        this.loadSemesters()
        this.loadTracks()
        this.loadGradeLevels()
        this.loadOtherFees()
    },


    computed: {
        totalFee(){
            let total = 0
            this.enrollee.section_subjects.forEach(item => {
                total += Number(item.subject.fee)
            });

            let oFees = 0
            this.otherFees.forEach(item =>{
                oFees += item.amount
            })
            
            this.finalTotalFee = total + oFees
            return total
        }
    }
}
</script>

<style scoped>

.info-header{
    background-color: green;
    padding: 10px;
    color: white;
}
.subject-card{
    margin: 10px 0px 5px 0px;
    border: 1px solid gray;
    padding: 15px;
}
</style>