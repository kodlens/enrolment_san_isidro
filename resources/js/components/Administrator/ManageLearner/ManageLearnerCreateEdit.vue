<template>
    <section class="section">
        <div class="columns is-centered">
            <div class="column is-8-widescreen is-8-desktop is-10-tablet">
                <form @submit.prevent="submit">

                    <div class="box">
                        <div class="box-title mb-2">
                            LEARNER REGISTRATION FORM
                        </div>

                        <div class="panel-body">

                            <!-- <b-button class="button is-info is-outlined"
                                    @click="debug">DEBUG</b-button> -->
                                    
                            <div class="divider">LEARNER INFORMATION</div>

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
                                            required>
                                            <option :value="{ grade_level: item.grade_level, curriculum_code: item.curriculum_code }"
                                                    v-for="(item, ix) in gradeLevels" :key="`g${ix}`">
                                                {{ item.grade_level }}
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
                                            required
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
                            <div class="columns">
                                <!-- <div class="column" v-if="fields.learner_status === 0">
                                    <b-field label="School Id"
                                             :type="this.errors.school_id ? 'is-danger':''"
                                             :message="this.errors.school_id ? this.errors.school_id[0] : ''" >
                                        <b-input icon="account" placeholder="School Id"
                                                 v-model="fields.school_id"
                                                 type="text"></b-input>
                                    </b-field>
                                </div> -->

                                <div class="column">
                                    <b-field label="LRN"
                                             :type="this.errors.lrn ? 'is-danger':''"
                                             :message="this.errors.lrn ? this.errors.lrn[0] : ''" >
                                        <b-input icon="account" placeholder="LRN" v-model="fields.lrn" type="text"></b-input>
                                    </b-field>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Last Name"
                                             :type="this.errors.lname ? 'is-danger':''"
                                             :message="this.errors.lname ? this.errors.lname[0] : ''" >
                                        <b-input icon="account" placeholder="Last Name" v-model="fields.lname"
                                                 type="text" required></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="First Name"
                                             :type="this.errors.fname ? 'is-danger':''"
                                             :message="this.errors.fname ? this.errors.fname[0] : ''">
                                        <b-input icon="account" v-model="fields.fname" placeholder="First Name"
                                                 type="text" required></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Middle Name">
                                        <b-input v-model="fields.mname" type="text" placeholder="Middle Name"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Extension (Jr, III, Sr.)">
                                        <b-input type="text" v-model="fields.extension" placeholder="Extension (Jr, III, Sr.)"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Sex" expanded
                                             :type="this.errors.sex ? 'is-danger':''"
                                             :message="this.errors.sex ? this.errors.sex[0] : ''">
                                        <b-select placeholder="Sex" v-model="fields.sex" icon="account"
                                                  required expanded>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Birthdate"
                                             :type="this.errors.birthdate ? 'is-danger':''"
                                             :message="this.errors.birthdate ? this.errors.birthdate[0] : ''">
                                        <b-datepicker v-model="fields.birthdate" 
                                            @input="computeAge"
                                            editable
                                            placeholder="Birthdate"
                                            required></b-datepicker>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Birthplace"
                                        :type="this.errors.birthplace ? 'is-danger':''"
                                        :message="this.errors.birthplace ? this.errors.birthplace[0] : ''">
                                        <b-input type="text" v-model="fields.birthplace" placeholder="Birthplace"></b-input>
                                    </b-field>
                                </div>
                                <div class="column is-2">
                                    <b-field label="Age"
                                        :type="this.errors.age ? 'is-danger':''"
                                        :message="this.errors.age ? this.errors.age[0] : ''">
                                        <b-input type="number" v-model="fields.age"
                                            max="120"
                                            readonly
                                            placeholder="Age"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Last School Attended"
                                        :type="this.errors.last_school_attended ? 'is-danger':''"
                                        :message="this.errors.last_school_attended ? this.errors.last_school_attended[0] : ''">
                                        <b-input type="text" v-model="fields.last_school_attended" placeholder="Last School Attended"></b-input>
                                    </b-field>
                                </div> <!--col--> 
                            </div> <!--cols-->

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Religion"
                                        :type="errors.religion ? 'is-danger':''"
                                        :message="errors.religion ? errors.religion[0] : ''">
                                        <b-input type="text" v-model="fields.religion" placeholder="Religion"></b-input>
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Contact No."
                                        :type="errors.contact_no ? 'is-danger':''"
                                        :message="errors.contact_no ? errors.contact_no[0] : ''">
                                        <b-input type="text" v-model="fields.contact_no" placeholder="Contact No."></b-input>
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Email"
                                        :type="errors.email ? 'is-danger':''"
                                        :message="errors.email ? errors.email[0] : ''">
                                        <b-input type="text" v-model="fields.email" placeholder="Email"></b-input>
                                    </b-field>
                                </div> <!--col--> 
                            </div> <!--cols-->

                            <!-- Current Address -->

                            <div class="mb-2">
                                <h2><span>Current Address</span></h2>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Province" expanded
                                             :type="this.errors.province ? 'is-danger':''"
                                             :message="this.errors.province ? this.errors.province[0] : ''">
                                        <b-select v-model="fields.province" expanded placeholder="Province" @input="loadCities">
                                            <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="City/Municipality" expanded
                                             :type="this.errors.city ? 'is-danger':''"
                                             :message="this.errors.city ? this.errors.city[0] : ''">
                                        <b-select expanded v-model="fields.city" placeholder="City" @input="loadBarangays">
                                            <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Barangay" expanded
                                             :type="this.errors.barangay ? 'is-danger':''"
                                             :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                                        <b-select v-model="fields.barangay" expanded placeholder="Barangay">
                                            <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                                        </b-select>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="House #. Street">
                                        <b-input type="text"
                                                 v-model="fields.street"
                                                 placeholder="House #. Street"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Zip Code"
                                        :type="this.errors.current_zipcode ? 'is-danger':''"
                                        :message="this.errors.current_zipcode ? this.errors.current_zipcode[0] : ''">
                                        <b-input type="text"
                                            v-model="fields.current_zipcode"
                                            placeholder="Zip Code"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <!-- Current Address -->



                            <!-- Parents/Guardians Information -->
                            <div class="divider">PARENTS/GUARDIANS INFORMATION</div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Father Last Name"
                                             :type="this.errors.father_lname ? 'is-danger':''"
                                             :message="this.errors.father_lname ? this.errors.father_lname[0] : ''" >
                                        <b-input icon="account" placeholder="Father Last Name" v-model="fields.father_lname" type="text"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Father First Name"
                                             :type="this.errors.father_fname ? 'is-danger':''"
                                             :message="this.errors.father_fname ? this.errors.father_fname[0] : ''">
                                        <b-input icon="account" v-model="fields.father_fname" placeholder="Father First Name" type="text"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Father Middle Name">
                                        <b-input v-model="fields.father_mname" icon="account" type="text" placeholder="Father Middle Name"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Father Extension">
                                        <b-input v-model="fields.father_extension"
                                                 icon="account" type="text" placeholder="Father Extension"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Father Contact No."
                                             :type="this.errors.father_contact_no ? 'is-danger':''"
                                             :message="this.errors.father_contact_no ? this.errors.father_contact_no[0] : ''" >
                                        <b-input type="tel"
                                                 v-model="fields.father_contact_no"
                                                 icon="cellphone"
                                                 pattern="^(09|\+639)\d{9}$"
                                                 placeholder="Format: 09101112222"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Father Educ'l Attn">
                                        <b-input v-model="fields.father_education"
                                            icon="account" type="text" placeholder="Father Educ'l Attn"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Father Religion">
                                        <b-input v-model="fields.father_religion"
                                            icon="account" type="text" placeholder="Father Religion"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <hr>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Mother Maiden Last Name"
                                             :type="this.errors.mother_maiden_lname ? 'is-danger':''"
                                             :message="this.errors.mother_maiden_lname ? this.errors.mother_maiden_lname[0] : ''" >
                                        <b-input icon="account"
                                                 placeholder="Mother Maiden Last Name"
                                                 v-model="fields.mother_maiden_lname" type="text"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Mother Maiden First Name"
                                             :type="this.errors.mother_maiden_fname ? 'is-danger':''"
                                             :message="this.errors.mother_maiden_fname ? this.errors.mother_maiden_fname[0] : ''">
                                        <b-input icon="account"
                                                 v-model="fields.mother_maiden_fname"
                                                 placeholder="Mother Maiden First Name" type="text"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Mother Maiden Middle Name"
                                        :type="this.errors.mother_maiden_mname ? 'is-danger':''"
                                        :message="this.errors.mother_maiden_mname ? this.errors.mother_maiden_mname[0] : ''">
                                        <b-input v-model="fields.mother_maiden_mname"
                                            type="text"
                                            icon="account"
                                            placeholder="Mother Maiden Middle Name"></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Mother Maiden Contact No.">
                                        <b-input type="tel" v-model="fields.mother_maiden_contact_no"
                                                 pattern="^(09|\+639)\d{9}$"
                                                 placeholder="Format: 09101112222"></b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Mother Educ'l Attn">
                                        <b-input v-model="fields.mother_education"
                                             icon="account" type="text" placeholder="Mother Educ'l Attn"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Mother Religion">
                                        <b-input v-model="fields.mother_religion"
                                            icon="account" type="text" placeholder="Mother Religion"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <hr>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Guardian Last Name"
                                             :type="this.errors.guardian_lname ? 'is-danger':''"
                                             :message="this.errors.guardian_lname ? this.errors.guardian_lname[0] : ''" >
                                        <b-input icon="account" placeholder="Guardian Last Name" v-model="fields.guardian_lname" type="text"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Guardian First Name"
                                             :type="this.errors.guardian_fname ? 'is-danger':''"
                                             :message="this.errors.guardian_fname ? this.errors.guardian_fname[0] : ''">
                                        <b-input icon="account" v-model="fields.guardian_fname" placeholder="Guardian First Name" type="text"></b-input>
                                    </b-field>
                                </div>
                                <div class="column">
                                    <b-field label="Guardian Middle Name">
                                        <b-input v-model="fields.guardian_mname"
                                            icon="account"
                                            type="text" placeholder="Guardian Middle Name"></b-input>
                                    </b-field>
                                </div>
                            </div>


                            <div class="columns">
                                <div class="column">
                                    <b-field label="Guardian Extension">
                                        <b-input v-model="fields.guardian_extension"
                                            icon="account" type="text" placeholder="Guardian Extension"></b-input>
                                    </b-field>
                                </div>


                                <div class="column">
                                    <b-field label="Guardian Contact No."
                                        :type="this.errors.guardian_contact_no ? 'is-danger':''"
                                        :message="this.errors.guardian_contact_no ? this.errors.guardian_contact_no[0] : ''">
                                        <b-input type="text" v-model="fields.guardian_contact_no"
                                            icon="cellphone"
                                            required
                                            placeholder="Guardian Contact No."></b-input>
                                    </b-field>
                                </div>

                                <div class="column">
                                    <b-field label="Guardian Relationship">
                                        <b-input v-model="fields.guardian_extension"
                                            icon="account" type="text" placeholder="Guardian Relationship"></b-input>
                                    </b-field>
                                </div>

                               
                            </div>


                            <div v-if="fields.grade_level.curriculum_code === 'SHS'">
                                <!-- LEARNER IN SHS -->
                                <div class="divider">FOR LEARNERS IN SENIOR HIGH SCHOOL</div>

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

                                    <!-- <div class="column">
                                        <b-field label="School Id"
                                            :type="errors.senior_high_school_id ? 'is-danger':''"
                                            :message="errors.senior_high_school_id ? errors.senior_high_school_id[0] : ''">
                                            <b-input v-model="fields.senior_high_school_id"
                                                icon="account"
                                                type="text" placeholder="School Id"></b-input>
                                        </b-field>
                                    </div> -->
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

                            <hr>
                            <div class="buttons is-right">
                                <button :class="btnClass">Register</button>
                            </div>

                        </div> <!--panel -body-->
                    </div> <!--panel-->

                </form>
            </div><!--column-->
        </div><!--cols-->
    </section>
</template>

<script>
export default {

    props: ['propData', 'propDataId'],

    data(){
        return{

            id: 0,

            fields: {

                lrn: null,
                grade_level: {
                    grade_level: null,
                    curriculum_code: null
                },
                learner_status: null,
               
                lname: null,
                fname: null,
                mname: null,
                sex:null,
                age: null,
                birthdate: null,
                formatted_bdate: null,
                birthplace: null,
                age: null,

                last_school_attended: null,

                province: null,
                city: null,
                barangay: null,
                street: null,
                zipcode: null,

                father_fname: null,
                father_lname: null,
                father_mname: null,
                father_contact_no: null,

                mother_maiden_fname: null,
                mother_maiden_lname: null,
                mother_maiden_mname: null,
                mother_maiden_contact_no: null,

                guardian_fname: null,
                guardian_lname: null,
                guardian_mname: null,
                guardian_contact_no: null,

                semester: null,
                track_id: null,
                strand_id: null,

            },

            errors: {},

            gradeLevels: [],
  
            provinces: [],
            cities: [],
            barangays: [],

            semesters: [],
            tracks: [],
            strands: [],
            sections: [],

            btnClass: {
                'is-loading': false,
                'button': true,
                'is-primary': true
            }
        }
    },
    methods: {
        //ADDRESS
        loadProvinces: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },
        loadCities: function(){
            axios.get('/load-cities?prov=' + this.fields.province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangays: function(){
            axios.get('/load-barangays?prov=' + this.fields.province + '&city_code='+this.fields.city).then(res=>{
                this.barangays = res.data;
            })
        },
        //ADDRESS

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
        loadStrands(){
            axios.get('/load-strands?trackid=' +  this.fields.track_id).then(res=>{
                this.strands = res.data;
            })
        },
        loadGradeLevels(){
            axios.get('/load-grade-levels').then(res=>{
                this.gradeLevels = res.data;
                console.log(this.gradeLevels);
            })
        },

        computeAge() {
            var today = new Date();
            var birthDate = new Date(this.fields.birthdate);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            this.fields.age = age
        },


       


        submit(){
            this.btnClass['is-loading'] = true
            this.errors = {}; //clear all errors, to refresh errors

            //alternative
            const formatted_bdate = this.fields.birthdate.getFullYear() + '-' 
                + (this.fields.birthdate.getMonth() + 1).toString().padStart(2, "0") + '-' 
                + (this.fields.birthdate.getDate()).toString().padStart(2,'0')


            this.fields.formatted_bdate = formatted_bdate;

            if(this.id > 0){
                /* update */
                axios.put('/manage-learners/' + this.id, this.fields).then(res=>{
                    this.btnClass['is-loading'] = false

                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: "UPDATED!",
                            message: 'Data successfully updated.',
                            type: 'is-success',
                            onConfirm: ()=>  window.location = '/manage-learners'
                        });
                    }
                }).catch(err=>{
                    this.btnClass['is-loading'] = false

                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                        this.$buefy.dialog.alert({
                            title: 'Error!',
                            hasIcon: true,
                            message: 'Some fields are required. Please check fields marked red.',
                            type: 'is-danger',
                        })
                    }else{
                        alert('An error occured.');
                    }
                });
            }else{
                /* insert */
                this.btnClass['is-loading'] = false

                axios.post('/manage-learners', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: "SAVED!",
                            message: 'Data successfully saved.',
                            type: 'is-success',
                            onConfirm: ()=>  window.location = '/manage-learners'
                        });
                    }
                }).catch(err=>{
                    this.btnClass['is-loading'] = false

                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                        this.$buefy.dialog.alert({
                            title: 'Error!',
                            hasIcon: true,
                            message: 'Some fields are required. Please check fields marked red.',
                            type: 'is-danger',
                        })
                    }else{
                        alert('An error occured.');
                    }
                });
            }

        },

        initData(){


            this.loadProvinces();
 
            this.loadSemesters()
            this.loadTracks()
            this.loadGradeLevels()
            //this.loadSections()

            if(this.propDataId > 0){
                this.setData();
            }

        },

        async setData(){
            this.btnClass['is-loading'] = true

            let data = JSON.parse(this.propData)
            this.id = data.learner_id

            console.log(data)

            this.fields.grade_level = { grade_level: data.grade_level.grade_level, curriculum_code: data.grade_level.curriculum_code }
            console.log(data.grade_level);
            //this.fields.is_returnee = data.is_returnee
            //this.fields.psa = data.psa
            this.fields.learner_status = data.learner_status

            this.fields.lrn = data.lrn
            this.fields.lname = data.lname
            this.fields.fname = data.fname
            this.fields.mname = data.mname
            this.fields.extension = data.extension
            this.fields.sex = data.sex
            this.fields.birthdate = new Date(data.birthdate)
            this.fields.birthplace = data.birthplace
            this.fields.age = data.age
            // this.fields.mother_tongue = data.mother_tongue
            // this.fields.is_indigenous = data.is_indigenous
            // this.fields.if_yes_indigenous = data.if_yes_indigenous
            // this.fields.is_4ps = data.is_4ps
            // this.fields.household_4ps_id_no = data.household_4ps_id_no
            this.fields.last_school_attended = data.last_school_attended

            this.fields.province = data.province ? data.province.provCode : null
            await this.loadCities()
            this.fields.city = data.city ? data.city.citymunCode : null
            await this.loadBarangays()
            this.fields.barangay = data.barangay ? data.barangay.brgyCode : null
            this.fields.street = data.street
            this.fields.zipcode = data.zipcode

       
            this.fields.father_lname = data.father_lname
            this.fields.father_fname = data.father_fname
            this.fields.father_mname = data.father_mname
            this.fields.father_contact_no = data.father_contact_no
            this.fields.father_extension = data.father_extension

            this.fields.mother_maiden_lname = data.mother_maiden_lname
            this.fields.mother_maiden_fname = data.mother_maiden_fname
            this.fields.mother_maiden_mname = data.mother_maiden_mname
            this.fields.mother_maiden_contact_no = data.mother_maiden_contact_no

            this.fields.guardian_lname = data.guardian_lname
            this.fields.guardian_fname = data.guardian_fname
            this.fields.guardian_mname = data.guardian_mname
            this.fields.guardian_contact_no = data.guardian_contact_no

            this.fields.semester_id = data.semester_id
            //this.fields.senior_high_school_id = data.senior_high_school_id

            this.fields.track_id = data.track_id
            await this.loadStrands()
            this.fields.strand_id = data.strand_id
            
            this.btnClass['is-loading'] = false

        },

        debug(){

            this.fields.grade_level = { grade_level: 'GRADE 11', curriculum_code: 'SHS'}
            this.fields.learner_status = 'NEW'

            this.fields.lrn = '20221123231'
            this.fields.lname = 'LABAJO'
            this.fields.fname = 'MAYESEL'
            this.fields.mname = ''
            this.fields.extension = ''
            this.fields.sex = 'FEMALE'
            this.fields.birthdate = new Date('2001-01-20')
            this.fields.birthplace = 'TUDELA, MISAMIS OCCIDENTAL'
            this.fields.age = '22'
        
            this.fields.current_street = 'Juan Luna St.'
            this.fields.current_zipcode = '9210'

            this.fields.last_school_attended = 'TCNHS'

            this.fields.father_lname = 'FATHERLNAME'
            this.fields.father_fname = 'FATHERFNAME'
            this.fields.father_mname = 'FATHERMNAME'
            this.fields.father_contact_no = '09161234567'

            this.fields.mother_maiden_lname = 'MAIDENLAST'
            this.fields.mother_maiden_fname = 'MAIDENFIRST'
            this.fields.mother_maiden_mname = 'MAIDENTEST'
            this.fields.mother_maiden_contact_no = '09161234567'

            this.fields.guardian_lname = 'GLASTNAME'
            this.fields.guardian_fname = 'GFNAME'
            this.fields.guardian_mname = 'GMNAME'
            this.fields.guardian_contact_no = '09161234567'
           
            this.fields.last_school_year_completed = '2021-2022'

            //this.fields.last_schoold_id = '2022-2211'

            // this.fields.semester_id = 1
            // this.fields.senior_high_school_id = '200222'
            // this.fields.track_id = 1
            // this.fields.strand_id = 1

        }
    },


    mounted() {

        this.initData();


    }
}
</script>

<style scoped>


.box-title{
    font-weight: bold;
    font-size: 1.5rem;
    text-align: center;
}

/*    dere lang kubia ang panel color*/
</style>
