<template>

    <div>

        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">
                        <div class="has-text-weight-bold is-size-4">ENROLLMENT/ADMISSION</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            Admit learner, record the current grade level, track or strand.
                        </div>
                        <div class="has-text-weight-bold mb-4 info-header">LEARNER INFORMATON</div>
                        
                        <div>
                            <div class="columns">
                                <div class="column">
                                    <b-field
                                        :type="this.errors.learner_id ? 'is-danger':''"
                                        :message="this.errors.learner_id ? this.errors.learner_id[0] : ''">
                                        <modal-browse-learner
                                            :prop-name="learner.name"
                                            @browseLearner="emitBrowseLearner"></modal-browse-learner>
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Admission Date">
                                        <b-datepicker v-model="learner.admission_date" 
                                            placeholder="Date Enrolled"></b-datepicker>
                                    </b-field>
                                </div>
                            </div> <!--cols-->

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
                                            v-model="learner.grade_level"
                                            @input="loadInitData"
                                            required>
                                            <option :value="{ grade_level: item.grade_level, curriculum_code: item.curriculum_code }"
                                                    v-for="(item, ix) in gradeLevels" :key="`g${ix}`">
                                                {{ item.grade_level }}
                                            </option>
                                        </b-select >
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Section"
                                        expanded
                                        :type="this.errors.section_id ? 'is-danger':''"
                                        :message="this.errors.section_id ? this.errors.section_id[0] : ''" >
                                        <b-select
                                            expanded
                                            icon="account"
                                            placeholder="Section"
                                            v-model="learner.section_id"
                                            required>
                                            <option :value="item.section_id"
                                                    v-for="(item, ix) in sections" :key="`section${ix}`">
                                                {{ item.section }}
                                            </option>
                                        </b-select >
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Learner Status"
                                            expanded
                                            :type="this.errors.learner_status ? 'is-danger':''"
                                            :message="this.errors.learner_status ? this.errors.learner_status[0] : ''">
                                        <b-select expanded
                                            required
                                            icon="account"
                                            placeholder="Learner Status"
                                            v-model="learner.learner_status">
                                            <option value="OLD">OLD</option>
                                            <option value="NEW">NEW</option>
                                            <option value="RETURNEE">RETURNEE</option>
                                            <option value="TRANSFEREE">TRANSFEREE</option>
                                        </b-select>
                                    </b-field>
                                </div>

                            </div> <!--cols-->


                            <div v-if="learner.grade_level.curriculum_code === 'SHS'">

                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Semester" expanded
                                            :type="this.errors.semester_id ? 'is-danger':''"
                                            :message="this.errors.semester_id ? this.errors.semester_id[0] : ''">
                                            <b-select v-model="learner.semester_id" expanded
                                                icon="account"
                                                @input="loadSubjectBySemester"
                                                placeholder="Semester">
                                                <option :value="item.semester_id" v-for="(item, ix) in semesters" :key="ix">
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
                                            <b-select v-model="learner.track_id" expanded
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
                                            <b-select v-model="learner.strand_id" expanded
                                                    icon="account"
                                                    placeholder="Strand">
                                                <option :value="item.strand_id" v-for="(item, ix) in strands" :key="`strand${ix}`">
                                                    {{  item.strand }}
                                                </option>
                                            </b-select>
                                        </b-field>
                                    </div>
                                </div>
                            </div> <!--if SHS-->

                        </div>

                        <hr>

                        <div class="my-4">
                            <div class="has-text-weight-bold mb-4 info-header">SUBJECTS TO ENROLL</div>
                            <b-field
                                :type="this.errors.subjects ? 'is-danger':''"
                                :message="this.errors.subjects ? this.errors.subjects[0] : ''">
                            </b-field>
                            <div class="subject-card"
                                v-for="(item, index) in learner.subjects" :key="index">
                                
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Subjet Name" label-position="on-border">
                                            <b-input type="text" readonly v-model="item.subj_name" 
                                                placeholder="Subjet Name" /></b-field>
                                    </div>  
                                    <div class="column is-2">
                                        <b-field label="Class" label-position="on-border">
                                            <b-input type="text" readonly v-model="item.units " 
                                                placeholder="Class" /></b-field>
                                    </div> 

                                    <div class="column is-1">
                                        <div class="buttons is-right m-2">
                                            <b-button class="is-danger is-small is-outlined"
                                                icon-right="delete" @click="removeSubject(index)"></b-button>
                                        </div>
                                    </div>
                                    
                                </div> 

                            
                            </div>
                            <div class="buttons is-right mt-4">
                                <modal-browse-button-subject
                                    @browseSubject="emitBrowseSubject($event)"></modal-browse-button-subject>
                            </div>
                        </div> <!--if SHS-->
                        

                        <div class="has-text-weight-bold mb-4 info-header">CONTROLS/ACTION</div>

                        <div class="buttons mt-4 is-right">
                            <b-button class="is-primary has-text-weight-bold"
                                @click="submit"
                                label="SAVE ENROLLMENT" icon-right="arrow-right"></b-button>
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

            learner: {
                name: null,
                learner_id: null,
                admission_date: new Date(),
                grade_level: {},

                learner_status: null,

                semester_id: null,
                track_id: null,
                strand_id: null,
                section: 0,

                subjects: []
            },

            errors: {},

            gradeLevels: [],
            semesters: [],
            tracks: [],
            strands: [],
            sections: [],

        }
    },

    methods: {
        
        async emitBrowseLearner(row){

            this.learner.learner_id = row.learner_id
            this.learner.name = '(' + row.student_id + ') ' + row.lname + ', ' + row.fname + ' ' + row.mname
         
            this.learner.grade_level.grade_level = row.grade_level.grade_level
            this.learner.grade_level.curriculum_code = row.grade_level.curriculum_code
            await this.loadSections();
            await this.loadGradeLevelSubjects()

            this.learner.learner_status = row.learner_status
            //this.learner.semester_id = row.semester_id
            this.learner.track_id = row.track_id
            await this.loadStrands()
            this.learner.strand_id = row.strand_id
            this.learner.section_id = row.section_id

            await this.loadStrands().then(()=>{
                this.learner.strand_id = row.strand_id
            })
        },

        loadInitData(){
            this.loadGradeLevelSubjects()
            this.loadSections()
        },

        emitBrowseSubject(row, ix){
            let flagFound = false
            this.learner.subjects.forEach(item => {
                if(item.subject_id === row.subject_id){
                    flagFound = true;
                }
            });

            if(flagFound){
                this.$buefy.toast.open({
                    message: 'Already added in the subject list.',
                    type: 'is-danger'
                })
                return;
            }

            this.learner.subjects.push({
                subject_id: row.subject_id,
                subject_code: row.subject_code,
                subject_description: row.subject_description,
                units: row.units,
                class: row.class,
                fee: row.fee,
                subj_name: row.subject_code + ' - ' + row.subject_description
            })

        },

        removeSubject(index){
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to remove this subject?',
                type: 'is-danger',

                onConfirm: ()=>{
                    let id = this.learner.subjects[index].enrol_subject_id;

                    if(id > 0){
                        axios.delete('/enrolment-delete-subject/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Subject removed successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }
                    this.learner.subjects.splice(index, 1);
                }
            });
        },

        loadGradeLevelSubjects(){

            if(!["GRADE 11", "GRADE 12"].includes(this.learner.grade_level['grade_level'])){
                axios.get('/load-grade-level-subjects/' + this.learner.grade_level['grade_level']).then(res=>{
                    const subjects = res.data
                    this.learner.subjects = []

                    subjects.forEach(row => {
                    
                        this.learner.subjects.push({
                            subject_id: row.subject_id,
                            subject_code: row.subject.subject_code,
                            subject_description: row.subject.subject_description,
                            units: row.subject.units,
                            subj_name: row.subject.subject_code + ' - ' + row.subject.subject_description
                        })

                    });
                })
            }else{
                this.learner.semester_id = null
            }
        },

        loadSubjectBySemester(){
            if(["GRADE 11", "GRADE 12"].includes(this.learner.grade_level['grade_level'])){
                axios.get('/load-subjects-by-semester/' + this.learner.grade_level['grade_level'] + '/' + this.learner.semester_id).then(res=>{
                    const subjects = res.data
                    this.learner.subjects = []

                    subjects.forEach(row => {
                    
                        this.learner.subjects.push({
                            subject_id: row.subject_id,
                            subject_code: row.subject.subject_code,
                            subject_description: row.subject.subject_description,
                            units: row.subject.units,
                            subj_name: row.subject.subject_code + ' - ' + row.subject.subject_description
                        })

                    });
                })
            }
        },

        submit(){
            this.errors = {}

            axios.post('/enrollment', this.learner).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: "Saved!",
                        message: 'Data successfully saved.',
                        type: 'is-success',
                        onConfirm: ()=>  this.clearFields()
                    });
                }
            }).catch(err=>{
                if(err.response.status === 422){
                    this.errors = err.response.data.errors

                    if(this.errors.message[0] === 'exist'){
                        this.$buefy.dialog.alert({
                            title: "Exist!",
                            message: 'Learner already admitted.',
                            type: 'is-danger'
                        });
                    }
                }
            })
        },

        clearFields(){
            this.learner = {
                name: null,
                learner_id: null,
                admission_date: new Date(),
                grade_level: {},
                section_id: null,
                learner_status: null,

                semester_id: null,
                track_id: null,
                strand_id: null,

                subjects: []
       

            };
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
            axios.get('/load-strands?trackid=' +  this.learner.track_id).then(res=>{
                this.strands = res.data;
            })
        },
        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data;
            })
        },
        loadSections(){
            axios.get('/load-section?grade=' + this.learner.grade_level.grade_level).then(res=>{
                this.sections = res.data;
            })
        },
    },

    mounted(){
        this.loadSemesters()
        this.loadTracks()
        this.loadGradeLevels()
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