<template>
    <div>

        <v-row>
            <v-col cols="12" sm="6" class="mx-auto">
                <v-card>
                    <v-card-text>
                        <center>
                            <h1 class="font-weight-light"><country-flag :country='country' size='big'/> GHANA</h1>

                        </center>
                        <v-col cols="12" sm="12">
                            <v-select
                            label="Select Network"
                            :items="networks"
                            outlined
                            v-model="network"
                            >

                            </v-select>
                        </v-col>

                        <v-col cols="12" sm="12">
                           <v-text-field
                            label="Recipient Phone number"
                            outlined
                            prefix="+233"
                            v-model="phone_number"

                           ></v-text-field>
                        </v-col>


                        <v-col cols="12" sm="12">
                           <v-text-field
                            label="Amount"
                            outlined
                            prefix="GHS"
                            v-model="amount"
                            type="number"

                           ></v-text-field>
                        </v-col>

                        <v-subheader>Other Information</v-subheader>

                        <v-col cols="12" sm="12">
                            <v-text-field
                                label="Recipient E-Mail Address"
                                outlined
                                type="email"
                                v-model="recipient_email"

                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="12">
                            <v-text-field
                                label="Your E-Mail Address"
                                outlined
                                type="email"
                                v-model="sender_email"

                            ></v-text-field>
                        </v-col>



                        <v-col cols="12" sm="12">
                            <v-textarea
                                label="Your Message"
                                outlined
                                rows="3"
                                auto-grow
                                v-model="message"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12" sm="12">
                            <v-btn @click="save" color="purple" dark block rounded>
                                Continue <v-icon>mdi-arrow-right</v-icon>
                            </v-btn>
                        </v-col>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

    </div>

</template>

<script>
    export default {
        name: "aitimeComponent",
        data(){
            return{
                network:'',
                amount:0.0,
                country:'GH',
                recipient_email:'',
                sender_email:'',
                message:'',
                phone_number:'',

                progress:true,
                bills:[],
                networks:[
                    {
                        value:'VODAFONE VTU',
                        text:'VODAFONE'
                    },
                    {
                        value:'MTN VTU',
                        text:'MTN'
                    },
                    {
                        value:'TIGO VTU',
                        text:'TIGO'
                    }
                ]
            }
        },
        methods:{
         save(){
             let formData = new FormData();
             formData.append('country',this.country);
             formData.append('biller_name',this.network);
             formData.append('amount',this.amount);
             formData.append('customer','+233265653314');
             formData.append('type','AIRTIME');
             formData.append('recurrence','ONCE');
             axios.post('/api/buyairtime',formData)
                    .then(res=>{
                       console.log(res.data);
                    });

         }

        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
