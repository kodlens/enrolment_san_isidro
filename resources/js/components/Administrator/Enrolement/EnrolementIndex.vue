<template>

    <div>

        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8-widescreen is-10-desktop is-10-tablet">

                    <div class="box">

                        <div class="has-text-weight-bold">LEARNER INFORMATON</div>
                        <div>
                            <modal-browse-learner
                                :prop-name="learner.name"
                                @browseLearner="emitBrowseLearner"></modal-browse-learner>
                        </div>

                        <hr>

                        <div class="has-text-weight-bold">SUBJECT</div>
                        <div v-for="(item,ix) in learner.subjects" :key="ix">
                            <modal-browse-subject
                                :prop-name="subject.name"
                                @browseSubject="emitBrowseSubject"></modal-browse-subject>
                        </div>
                        <div class="buttons is-right">
                            <b-button @click="addSubject" label="Add Subject"
                                class="is-outlined"></b-button>
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

                subjects: {
                    subject_code: null,
                    subject_description: null,
                    units: null,
                    class: null,
                    fee: null,
                }

            },

        }
    },

    methods: {
        
        emitBrowseLearner(row){
            this.learner.learner_id = row.learner_id
            this.learner.name = row.lname + ', ' + row.fname + ' ' + row.mname

        },

        addSubject(){
            this.learner.subjects.push({
                subject_code: null,
                subject_description: null,
                units: null,
                class: null,
                fee: null,
            })
        }

    },

    mounted(){

    }
}
</script>