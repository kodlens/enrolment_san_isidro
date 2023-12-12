<template>

    <div>

        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">
                        <div class="has-text-weight-bold is-size-4">BILLING PAYMENT</div>
                        <div class="has-text-weight-bold mb-4 is-size-6">
                            Payment of the bill/fees of the student.
                        </div>

                        <div class="has-text-weight-bold mb-4 info-header">BILLING INFORMATON</div>
                        
                        <div>
                            <div class="columns">
                                <div class="column">
                                    <b-field
                                        :type="this.errors.learner_id ? 'is-danger':''"
                                        :message="this.errors.learner_id ? this.errors.learner_id[0] : ''">
                                        <modal-browse-billing
                                            :prop-name="billing.name"
                                            @browseBilling="emitBrowseBilling"></modal-browse-billing>
                                    </b-field>
                                </div> <!--col--> 
                                <div class="column">
                                    <b-field label="Date Billed">
                                        <b-datepicker v-model="billing.date_bill" 
                                            placeholder="Date Enrolled"></b-datepicker>
                                    </b-field>
                                </div>
                            </div> <!--cols-->

                            <div class="columns">
                                <div class="column">
                                    <b-field
                                        label="Balance">
                                        <b-input type="text" 
                                            v-model="billing.fee_balance" readonly></b-input>
                                    </b-field>
                                </div> <!--col--> 
                            </div> <!--cols-->

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Payment Date">
                                        <b-datepicker v-model="billing.date_paid" 
                                            placeholder="Payment Date"></b-datepicker>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field
                                        label="Payment">
                                        <b-numberinput
                                            v-model="billing.payment" size="is-large" 
                                            :controls="false"></b-numberinput>
                                    </b-field>
                                </div> <!--col--> 
                            </div> <!--cols-->

                        </div>

                        <hr>

                        <div class="has-text-weight-bold mb-4 info-header">CONTROLS/ACTION</div>

                        <div class="buttons mt-4 is-right">
                            <b-button class="is-primary has-text-weight-bold"
                                @click="submit"
                                label="SAVE PAYMENT" icon-right="arrow-right"></b-button>
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

            billing: {
                academic_year_id: null,
                enroll_id: null,
                learner_id: null,
                name: null,
                date_bill: new Date(),
                fee_balance: 0,
                payment: 0,
                date_paid: new Date()
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
        
        emitBrowseBilling(row){
            console.log(row);

            this.billing.learner_id = row.learner.learner_id
            this.billing.enroll_id = row.enroll_id
            this.billing.academic_year_id = row.academic_year_id
            this.billing.fee_balance = row.fee_balance
            this.billing.billing_id = row.billing_id

            this.billing.name = row.learner.lname + ', ' + row.learner.fname + ' ' + row.learner.mname
            
        },

       

        submit(){
            this.errors = {}
           
            axios.post('/billing-payment', this.billing).then(res=>{
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

                    if(this.errors.exist){
                        this.$buefy.dialog.alert({
                            title: "Exist!",
                            message: this.errors.exist[0],
                            type: 'is-danger'
                        });
                    }

                    if(this.errors.lower){
                        this.$buefy.dialog.alert({
                            title: "Invalid!",
                            message: this.errors.lower[0],
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
        loadSections(){
            axios.get('/load-sections').then(res=>{
                this.sections = res.data;
            })
        },


        clearFields(){
            this.billing = {
                academic_year_id: null,
                enroll_id: null,
                learner_id: null,
                name: null,
                date_bill: new Date(),
                fee_balance: 0,
                payment: 0,
                date_paid: new Date()

            };
        },

    },

    

    mounted(){
        this.loadSemesters()
        this.loadTracks()
        this.loadGradeLevels()
    },


    computed: {
        totalFee(){
            let total = 0
            this.enrollee.subjects.forEach(item => {
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