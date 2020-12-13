<template>
    <div>
        <v-skeleton-loader v-if="progress" type="table"></v-skeleton-loader>


    </div>

</template>

<script>
    export default {
        name: "aitimeComponent",
        data(){
            return{
                progress:true,
                bills:[]
            }
        },
        methods:{
            get_airtime(){
                axios.get('/api/artime')
                    .then(res=>{
                       this.bills = res.data;

                    })
                .catch(error=>{

                })
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
