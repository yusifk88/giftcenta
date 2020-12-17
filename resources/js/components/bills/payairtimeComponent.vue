<template>
    <div>
        <v-row>
            <v-col cols="12" sm="6" class="mx-auto">
                <v-card>
                    <v-skeleton-loader v-if="progress" type="list-item@10"></v-skeleton-loader>
                    <v-card-text v-else>
                        <center>
                            <h1 class="font-weight-light"><country-flag :country='airtime.country' size='big'/> GHANA</h1>

                            <h1 class="font-weight-thin">GHS{{airtime.amount}} AIRTIME FROM {{airtime.sender_name}} TO {{airtime.phone_number}}.</h1>

                            <h3 class="font-weight-thin">
                                <strong>Amount: </strong> GHS{{airtime.amount}}<br>
                                <strong>service Charge: </strong> GHS0.00<br>
                                <strong>Amount Due: </strong> GHS{{airtime.amount}}<br>
                            </h3>

                            <v-btn block v-if="airtime.paid === 0" color="success" large @click="makePayment">Checkout now</v-btn>
                            <v-alert type="success" outlined v-else>
                                This airtime payment was already made to {{airtime.phone_number}}, consider initiating an new payment if you want to send airtime again.
                               <br> <v-btn text color="blue" to="/buyairtime">New Airtime</v-btn>
                            </v-alert>

                        </center>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>

</template>

<script>
    export default {
        name: "payairtimeComponent",
        data(){
            return{
                airtime:null,
                progress:true
            }
        },
        methods:{

            get_airtime(){
                this.progress=true;
                axios.get('/api/airtime/'+this.$route.params.id)
                    .then(res=>{
                        this.airtime=res.data;
                        this.progress=false;
                    })
            },
            makePayment() {
                let f =  this.$launchFlutterwave({
                    tx_ref: Date.now()+"_airtime",
                    amount: this.airtime.amount,
                    country:'GH',
                    currency: 'GHS',
                    payment_options: 'card,mobilemoney,ussd',
                    redirect_url:'/sendairtime/'+this.airtime.id,
                    customer: {
                        email: this.airtime.sender_email,
                        name: this.airtime.sender_name
                    },
                   customizations: {
                        title: 'Pay for GHS'+ this.airtime.amount +' airtime for '+this.airtime.phone_number,
                        logo: '/img/logo.png'
                    }
                });

            },


        },
        mounted() {

            this.get_airtime();

        }
    }
</script>

<style scoped>

</style>
