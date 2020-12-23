<template>
    <v-row class="bg-light">
        <v-col cols="12" sm="8" class="mx-auto">
            <v-row class="m-5" style="margin-bottom:30px;">
                <v-col cols="12" sm="12" class="text-center">
                    <h2 class="white--text font-weight-black">SURPRISE YOUR LOVED ONES BY PAYING THEIR BILLS</h2>
                    <span class="white--text font-weight-light">BUY AIRTIME, DATA BUNDLE, UTILITY BILLS OR VIRTUAL CARDS FOR YOUR LOVED ONES</span>
                </v-col>
            </v-row>

                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-carousel :show-arrows="false" height="500" :hide-delimiters=true>
                                <v-carousel-item
                                    v-for="(item,i) in items"
                                    :key="i"
                                    :src="item.src"
                                ></v-carousel-item>
                            </v-carousel>
                        </v-col>
                        <v-col tile cols="12"  sm="6" class="text-center">
                            <h2 v-if="$vuetify.breakpoint.mdAndUp" class="font-weight-light white--text" style="margin-top:100px;">BUY & SEND A VIRTUAL CARD AS A GIFT</h2>
                            <br/>
                            <v-btn depressed class="m-2" to="/buycard" dark block color="purple" rounded>buy virtual card</v-btn> <br>
                            <v-btn depressed class="m-2" to="/buyairtime" dark block color="amber" rounded>buy airtime</v-btn><br>
<!--                            <v-btn depressed class="m-2" to="/buydstv" dark block color="teal" rounded>Pay Dstv Bill</v-btn>-->
                        </v-col>
                    </v-row>




                    <v-row>
                        <v-col cols="12" sm="12">
                         <BillsComponent :bills="bills"></BillsComponent>
                        </v-col>
                    </v-row>



        </v-col>

    </v-row>

</template>

<script>
    import BillsComponent from "./BillsComponent";
    export default {
        name: "indexComponent",
        components:{
            BillsComponent
        },
        data(){
            return{


                bills:[],
                items: [
                    {
                        src: '/img/shop_order.png',
                    },
                    {
                        src: '/img/credit_card.png',
                    },
                    {
                        src: '/img/shop_with_card.png',
                    },


                ],
            }
        },
        methods:{
            get_bills(){
                axios.get('/api/bills')
                    .then(res=>{
                        this.bills = res.data;
                    })
            }

        },
        mounted(){
            this.get_bills();

        }
    }
</script>

<style scoped>
    .blur-card{

        background-color:rgba(255,255,255,0.95) !important;
    }

</style>
