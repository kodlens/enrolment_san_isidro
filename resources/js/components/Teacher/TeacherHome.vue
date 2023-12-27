<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-6">
                    <div class="box">
                        <h1 class="title is-5">WELCOME TEACHER</h1>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return{
            appointment: {},
        }
    },

    methods: {
        getUpcommingAppointment(){
            axios.get('/my-upcoming-appointment').then(res=>{
                this.appointment = res.data;
            })
        }
    },
    mounted() {
        
    }
}
</script>
<style scoped>

</style>
