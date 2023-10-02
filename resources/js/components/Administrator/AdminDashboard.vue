<template>
    <div>
        <div class="welcome-container">

            <div class="logo-wrapper">
                <img src="/img/tudela_logo.png" class="tcnhs-logo" alt="TCNHS Logo">
            </div>
           
            <div class="loader-3">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>

            <div class="welcome-text">
                WELCOME ADMINISTRATOR
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
	data(){
		return{
            info: {},

		}
	},

	methods:{
	},

    mounted() {
    }
}
</script>

<style scoped src="../../../css/admin-home.css">
</style>
