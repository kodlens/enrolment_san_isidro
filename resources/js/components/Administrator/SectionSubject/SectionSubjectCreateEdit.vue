<template>

    <div>

        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">
                        <div class="has-text-weight-bold is-size-4">ADD/EDIT SECTION SUBJECT</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            Manage (add/edit) subjects per section.
                        </div>
                        <div class="has-text-weight-bold mb-4 info-header">SECTION INFORMATION</div>
                        
                        <div>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Academic Year" expanded>
                                        <b-select v-model="fields.academic_year_id" 
                                            expanded
                                            placeholder="Academic Year">
                                            <option v-for="(item, ix) in academicYears" :key="`ay${ix}`" 
                                                :value="item.academic_year_id">
                                                {{ item.academic_year_code }} - {{ item.academic_year_desc }}
                                            </option>
                                        </b-select>
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
                                            v-model="fields.grade_level"
                                            @input="loadSection"
                                            required>
                                            <option :value="{ grade_level: item.grade_level, curriculum: item.curriculum }"
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
                                            v-model="fields.section_id"
                                            required>
                                            <option :value="item.section_id"
                                                    v-for="(item, ix) in sections" :key="`section${ix}`">
                                                {{ item.section }}
                                            </option>
                                        </b-select >
                                    </b-field>
                                </div> <!--col--> 

                            </div> <!--cols-->


                            <div v-if="fields.grade_level.curriculum === 'SHS'">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Semester" expanded
                                            :type="this.errors.semester_id ? 'is-danger':''"
                                            :message="this.errors.semester_id ? this.errors.semester_id[0] : ''">
                                            <b-select v-model="fields.semester_id" expanded
                                                icon="account"
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
                                            <b-select v-model="fields.track_id" expanded
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
                                            <b-select v-model="fields.strand_id" expanded
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

                        <div class="has-text-weight-bold mb-4 info-header">SUBJECTS TO ENROLL</div>
                        <b-field
                            :type="this.errors.subjects ? 'is-danger':''"
                            :message="this.errors.subjects ? this.errors.subjects[0] : ''">
                        </b-field>
                        <!-- subjects loop -->
                        <div class="subject-card"
                            v-for="(item, index) in fields.subjects" :key="index">
                            <div class="buttons is-right m-2">
                                <b-button class="is-danger is-small is-outlined"
                                    icon-right="delete" @click="removeSubject(index)"></b-button>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Subjet Name" label-position="on-border">
                                        <b-input type="text" readonly v-model="item.subj_name" 
                                            placeholder="Subjet Name" /></b-field>
                                </div> <!--col--> 
                            </div> <!--cols-->
                        </div>
                        <div class="buttons is-right mt-4">
                            <modal-browse-button-subject
                                @browseSubject="emitBrowseSubject($event)"></modal-browse-button-subject>
                        </div>

                        <div class="has-text-weight-bold mb-4 info-header">CONTROLS/ACTION</div>

                        <div class="buttons mt-4 is-right">
                            <b-button class="is-primary has-text-weight-bold"
                                @click="submit"
                                label="SAVE SECTION SUBJECTS" icon-right="arrow-right"></b-button>
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
            section_subjects: {},

            fields: {
                grade_level: {},
                subjects: []
            },
            errors: {},

            gradeLevels: [],
            academicYears: [],
            sections: [],
            tracks: [],
            strands: [],
            semesters: [],


        }
    },

    methods: {

        emitBrowseSubject(row, ix){

            this.fields.subjects.push({
                subject_id: row.subject_id,
                subject_code: row.subject_code,
                subject_description: row.subject_description,
                units: row.units,
                subj_name: row.subject_code + ' - ' + row.subject_description
            })

        },

        removeSubject(index){

            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to remove this subject?',
                type: 'is-danger',

                onConfirm: ()=>{
                    let id = this.fields.subjects[index].enrol_subject_id;

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

                    this.fields.subjects.splice(index, 1);
                }
            });
        },

        submit(){
            this.errors = {}
            axios.post('/section-subjects', this.fields).then(res=>{
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
            
        },


        async loadAcademicYears(){
            await axios.get('/load-academic-years').then(res=>{
                this.academicYears = res.data

                this.academicYears.forEach(item =>{
                    if(item.is_active === 1){
                        this.fields.academic_year_id = item.academic_year_id
                    }
                })
            }).catch(err=>{
            
            })
        },

        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data;
            })
        },
        loadSection(){
            this.fields.section_id = null
            axios.get('/load-section?grade=' + this.fields.grade_level.grade_level).then(res=>{
                this.sections = res.data;
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
            axios.get('/load-strands?trackid=' +  this.fields.track_id).then(res=>{
                this.strands = res.data;
            })
        },

    },

    mounted(){
        this.loadAcademicYears()
        this.loadGradeLevels()
        this.loadTracks()
        this.loadSemesters()

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