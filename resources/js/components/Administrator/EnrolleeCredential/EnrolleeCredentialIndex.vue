<template>

    <div>

        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">
                        <div class="has-text-weight-bold is-size-4">ENROLLEE CREDENTIALS</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            Upload/manage credentials or documents of the learner.
                        </div>
                        <div class="has-text-weight-bold mb-4 info-header">LEARNER INFORMATON</div>
                        
                        <div>
                            <div class="columns">
                                <div class="column">
                                    <b-field
                                        :type="this.errors.learner_id ? 'is-danger':''"
                                        :message="this.errors.learner_id ? this.errors.learner_id[0] : ''">
                                        <modal-browse-enrollee
                                            :prop-name="fields.name"
                                            @browseEnrollee="emitBrowseEnrollee"></modal-browse-enrollee>
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Date Process">
                                        <b-datepicker v-model="fields.date_enrolled" 
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
                                            v-model="fields.grade_level"
                                            disabled>
                                            <option :value="item.grade_level"
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
                                            v-model="fields.section_id"
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
                                            v-model="fields.learner_status">
                                            <option value="OLD">OLD</option>
                                            <option value="NEW">NEW</option>
                                            <option value="RETURNEE">RETURNEE</option>
                                            <option value="TRANSFEREE">TRANSFEREE</option>
                                        </b-select>
                                    </b-field>
                                </div>

                            </div>


                            <div v-if="fields.grade_level.curriculum === 'SHS'">
                                <div class="columns">
                                    <div class="column">
                                        <b-field label="Semester" expanded
                                            :type="this.errors.semester_id ? 'is-danger':''"
                                            :message="this.errors.semester_id ? this.errors.semester_id[0] : ''">
                                            <b-select v-model="fields.semester_id" expanded
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

                        <div class="has-text-weight-bold mb-4 info-header">CREDENTIALS</div>
                        <div style="color: red; font-weight: bold;">PDF Format only.</div>
                        <b-field
                            :type="this.errors.credentials ? 'is-danger':''"
                            :message="this.errors.credentials ? this.errors.credentials[0] : ''">
                        </b-field>
                        <!-- subjects loop -->

                        <div class="subject-card">
                            <div class="has-text-weight-bold">CREDENTIALS</div>

                         
                            <div v-for="(item,index) in fields.credentials" :key="`cred${index}`">
                                <div class="columns">
                                    <div class="column">
                                        <b-field class="file is-primary" :class="{'has-name': !!item.credential}">
                                            <b-upload v-model="item.credential" accept=".pdf" 
                                                class="file-label">
                                                <span class="file-cta">
                                                    <b-icon class="file-icon" icon="upload"></b-icon>
                                                    <span class="file-label">Click to upload</span>
                                                </span>
                                                <span class="file-name" v-if="item.credential">
                                                    {{ item.credential.name }}
                                                </span>
                                            </b-upload>
                                        </b-field>
                                    </div>
                                    <div class="column">
                                        <b-field label="Description" label-position="on-border">
                                            <b-input type="text" placeholder="File Description"
                                                v-model="item.credential_name"></b-input>
                                        </b-field>
                                    </div>
                                    <div class="column is-1">
                                        <b-button type="is-danger" @click="removeFile(index)" icon-left="delete"></b-button>
                                    </div>
                                </div>
                               

                            </div>
                            
                            <div class="buttons is-right mt-4">
                                <b-button label="New Credential" @click="newCredential"></b-button>
                            </div>

                            <!-- <table class="table">
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Grade</th>
              
                                </tr>
                                <tr v-for="(item, index) in enrollee.section_subjects" :key="index">
                                    <td>{{  item.subject.subject_code }}</td>
                                    <td>{{  item.subject.subject_description }}</td>
                                    <td>
                                        <b-input type="text" v-model="item.grade" placeholder="Grade"></b-input>
                                    </td>
                                  
                                </tr>
                            </table>
                          
                            <div v-for="(item, ix) in otherFees" :key="`other${ix}`">
                                <div>{{ item.description }} - {{ item.amount }}</div>
                            </div>
                            <div>TOTAL SUBJECT FEE: <span>0</span></div>
                            <div class="has-text-weight-bold">TOTAL FEE: <span>0.00</span></div>
                           -->


                        </div>
                  

                        <div class="has-text-weight-bold mb-4 info-header">CONTROLS/ACTION</div>

                        <div class="buttons mt-4 is-right">
                            <b-button :class="btnClass"
                                @click="submit"
                                label="SAVE STUDENT CREDENTIAL" icon-right="arrow-right"></b-button>
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

            fields: {
                name: null,
                learner_id: null,
                date_enrolled: new Date(),
                grade_level: {},

                learner_status: null,

                semester_id: null,
                track_id: null,
                strand_id: null,
                section_id: null,

                credentials: [],
               
            },

            errors: {},

            gradeLevels: [],
            semesters: [],
            tracks: [],
            strands: [],
            sections: [],

            otherFees: [],

            btnClass: {
                'is-primary': true,
                'has-text-weight-bold': true,
                'is-loading': false
            }
        }

        
    },

    methods: {
        
        async emitBrowseEnrollee(row){
           
            this.fields.learner_id = row.learner.learner_id
            this.fields.enroll_id = row.enroll_id
            this.fields.academic_year_id = row.academic_year_id
            this.fields.name = row.learner.lname + ', ' + row.learner.fname + ' ' + row.learner.mname
            this.fields.grade_level = row.grade_level.grade_level
            this.fields.curriculum = row.grade_level.curriculum
            this.fields.learner_status = row.learner_status
            this.fields.semester_id = row.semester_id
            this.fields.track_id = row.track_id
            
            await this.loadSection()

            this.fields.section_id = row.section_id
         
            await this.loadStrands().then(()=>{
                this.fields.strand_id = row.strand_id
            })

            //this.loadOtherFees()
        },


        


        newCredential(){
            this.fields.credentials.push({
                credential_name: null,
                credential: {}
            });
        },
        removeFile(ix){
            this.$buefy.dialog.confirm({
                title: 'DELETE?',
                message: 'Are you sure you want to remove this subject?',
                type: 'is-danger',

                onConfirm: ()=>{
                    let id = this.fields.credentials[ix].credential_id;

                    if(id > 0){
                        axios.delete('/credential-delete/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.toast.open({
                                    message: `Credential removed successfully.`,
                                    type: 'is-primary'
                                })
                            }
                        });
                    }

                    this.fields.credentials.splice(ix, 1);
                }
            });
        },

        submit(){
            this.btnClass['is-loading'] = true
            this.errors = {}

            let formData =  new FormData();

            formData.append('learner_id', this.fields.learner_id ? this.fields.learner_id : '');
            //formData.append('date_time', this.fields.academic_year_id ? this.$formatDateAndTime(this.fields.academic_year_id) : '');

            //doc attachment

            if(this.fields.credentials.length > 0){
                this.fields.credentials.forEach((doc, index) =>{
                    console.log(doc.credential_name);
                    if(doc.credential.name){
                        formData.append(`credentials[${index}][credential_name]`, doc.credential_name ? doc.credential_name : '');
                        formData.append(`credentials[${index}][credential]`, doc.credential);
                    }
                });
            }
        
            axios.post('/enrollee-credentials', formData).then(res=>{
                this.btnClass['is-loading'] = false


                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: "Saved!",
                        message: 'Data successfully saved.',
                        type: 'is-success',
                        onConfirm: ()=>  window.location = 'enrollee-credentials'
                    });
                }
            }).catch(err=>{
                this.btnClass['is-loading'] = false

                if(err.response.status === 422){
                    this.errors = err.response.data.errors

                    if(this.errors.exist){
                        this.$buefy.dialog.alert({
                            title: "Exist!",
                            message: this.errors.exist[0],
                            type: 'is-danger'
                        });
                    }

                    // console.log(this.errors['credentials.0.credential_name']);

                    // if(this.errors.credentials){
                    //     this.$buefy.dialog.alert({
                    //         title: "Invalid data!",
                    //         message: 'Invalid input or empty fields, please check your credentials information.',
                    //         type: 'is-danger'
                    //     });
                    // }
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
            axios.get('/load-strands?trackid=' +  this.fields.track_id).then(res=>{
                this.strands = res.data;
            })
        },
        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data;
            })
        },
        loadSection(){
            axios.get('/load-section?grade=' + this.fields.grade_level).then(res=>{
                this.sections = res.data;
            })
        },


        clearFields(){
            this.fields = {
                name: null,
                learner_id: null,
                date_admission: new Date(),
                grade_level: null,

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
    },


    computed: {
        // totalFee(){
        //     let total = 0
        //     this.enrollee.section_subjects.forEach(item => {
        //         total += Number(item.subject.fee)
        //     });

        //     let oFees = 0
        //     this.otherFees.forEach(item =>{
        //         oFees += item.amount
        //     })
            
        //     this.finalTotalFee = total + oFees
        //     return total
        // }
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