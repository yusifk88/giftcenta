<template>
    <div>

        <v-row>
            <v-col cols="12" sm="6" class="mx-auto">
                <v-card>
                    <v-card-text>
                        <center>
                            <h1 class="font-weight-light"><country-flag :country='country' size='big'/> GHANA</h1>

                        </center>
                        <v-form ref="airtime_form">
                        <v-col cols="12" sm="12">
                            <v-select
                            label="Select Network"
                            :items="networks"
                            outlined
                            v-model="network"
                            :rules="[rules.required]"
                            >

                            </v-select>
                        </v-col>

                        <v-col cols="12" sm="12">
                           <v-text-field
                            label="Recipient Phone number"
                            outlined
                            placeholder="0200000012"
                            v-model="phone_number"
                            :rules="[rules.required,rules.counter,rules.is_number]"


                           ></v-text-field>
                        </v-col>


                        <v-col cols="12" sm="12">
                           <v-text-field
                            label="Amount"
                            outlined
                            prefix="GHS"
                            v-model="amount"
                            type="number"
                            :rules="[rules.required]"

                           ></v-text-field>
                        </v-col>

                        <v-subheader>Other Information</v-subheader>

                        <v-col cols="12" sm="12">
                            <v-text-field
                                label="Recipient E-Mail Address"
                                outlined
                                type="email"
                                v-model="recipient_email"
                                :rules="[rules.email]"

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
                            <v-text-field
                                label="Your Full Name"
                                outlined
                                v-model="sender_name"

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
                            <v-alert v-if="show_error" type="error">
                                <h5>{{error}}</h5>
                            </v-alert>
                        <v-col cols="12" sm="12">
                            <v-btn :loading="progress" @click="save" color="purple" dark block rounded>
                                Continue <v-icon>mdi-arrow-right</v-icon>
                            </v-btn>
                        </v-col>
                        </v-form>


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
                error:'',
                show_error:false,
                network:'',
                amount:0.0,
                country:'GH',
                recipient_email:'',
                sender_email:'',
                message:'',
                phone_number:'',
                sender_name:'',
                rules: {
                    required: value => !!value || 'Required.',
                    counter: value => value.length === 10  || 'Invalid phone number',
                    is_number: value => !isNaN(value)  || 'Invalid characters in phone number',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    }
                },

                progress:false,
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

            validate_number(){

                if (this.network === 'VODAFONE VTU'){
                    let posibilities = ['050','020'];

                    let ini_number = this.phone_number.substr(0,3);
                    if (posibilities.includes(ini_number)){
                        return true;
                    }else {
                            this.show_error =true;
                            this.error=this.phone_number+" dose not match the network selected.";

                        return false;
                    }
                }else if (this.network === 'MTN VTU'){

                    let posibilities = ['055','024','059'];

                    let ini_number = this.phone_number.substr(0,3);
                    if (posibilities.includes(ini_number)){
                        return true;
                    }else {
                        this.show_error =true;
                        this.error=this.phone_number+" dose not match the network selected.";

                        return false;
                    }


                }else {

                    let posibilities = ['026','027',];

                    let ini_number = this.phone_number.substr(0,3);
                    if (posibilities.includes(ini_number)){
                        return true;
                    }else {
                        this.show_error =true;
                        this.error=this.phone_number+" dose not match the network selected.";

                        return false;
                    }
                };


            },

         save(){
             if (this.$refs.airtime_form.validate()){
                 if(this.validate_number()){
                 this.progress=true;
             let formData = new FormData();
             formData.append('country',this.country);
             formData.append('biller_name',this.network);
             formData.append('amount',this.amount);
             formData.append('customer',this.phone_number);
             formData.append('type',this.network);
             formData.append('recurrence','ONCE');
             formData.append('recipient_email',this.recipient_email);
             formData.append('sender_email',this.sender_email);
             formData.append('sender_name',this.sender_name);
             formData.append('message',this.message);
             axios.post('/api/buyairtime',formData)
                    .then(res=>{

                        this.progress=false;

                        this.$router.push({
                            path:'/payairtime/'+res.data.id
                        });
                    })
                .catch(error=>{
                  if (error.response.status===302){
                      this.error=error.response.data;
                  }else {
                      this.error="Error: Could not process your request.";
                  }
                  this.show_error=true;
                });
             }
             }
         }

        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
