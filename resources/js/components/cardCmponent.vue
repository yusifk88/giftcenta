<template>

<v-row>
    <v-col cols="12" sm="6" class="mx-auto">
        <div class="card">
            <div class="card-body">

                        <v-timeline
                            align-top
                            dense
                            style="width: 100%"
                        >

                            <v-form ref="card_form">

                            <v-timeline-item
                                color="purple"
                                icon="mdi-credit-card"
                                fill-dot
                                right
                            >
                        <h4 class="purple--text">CARD INFORMATION</h4>

                       <v-row dense>
                         <v-col cols="12" sm="12">
                               <label>Amount <sup class="red--text">*</sup></label>
                               <v-text-field
                                   type="number"
                                   :prefix="currency"
                                   solo
                                   v-model="amount"
                                   :rules="[rules.required, rules.counter]"
                                   min="5"
                                   max="10000"
                                   @change="check_amount()"
                                   @keyup="check_amount()"

                               ></v-text-field>

                             <small class="text-danger" v-if="amount_error">The amount must be between $5 - $10,000</small>
                           </v-col>


                           <v-col cols="12" sm="12">
                               <label>Name you want on the card (preferably name of recipient).<sup class="red--text">*</sup></label>
                               <v-text-field
                                   solo
                                   v-model="name"
                                   :rules="requiredRules"
                               ></v-text-field>
                           </v-col>

                          </v-row>
                            </v-timeline-item>

                            <v-timeline-item
                                color="purple"
                                icon="mdi-account"
                                fill-dot
                                right
                            >

                           <v-row>
                           <h4 class="purple--text">YOUR INFORMATION</h4>
                           <v-col cols="12" sm="12">
                               <label>Your Full Name <sup class="red--text">*</sup></label>
                               <v-text-field
                                   solo
                                   v-model="sendername"
                                   :rules="requiredRules"

                               ></v-text-field>
                           </v-col>
                           <v-col cols="12" sm="12">
                               <label>Your E-Mail Address</label>
                               <v-text-field
                                   solo
                                   v-model="senderemail"
                                   :rules="[rules.required, rules.email]"
                                   type="email"

                               ></v-text-field>

                           </v-col>


                           <v-col cols="12" sm="12">
                               <label>Your Message</label>
                               <v-textarea
                                   solo
                                   v-model="message"
                                   :rules="requiredRules"
                                   auto-grow
                                   rows="3"
                               ></v-textarea>

                           </v-col>


                       </v-row>
                            </v-timeline-item>

                            <v-timeline-item
                                color="purple"
                                icon="mdi-account"
                                fill-dot
                                right
                            >

                           <v-row dense>
                       <h4 class="purple--text">RECIPIENT INFORMATION</h4>
                           <v-col cols="12" sm="12">
                               <label>Full Name <sup class="red--text">*</sup></label>
                               <v-text-field
                                   solo
                                   v-model="recipientname"
                                   :rules="requiredRules"

                               ></v-text-field>
                           </v-col>
                           <v-col cols="12" sm="12">
                               <label>E-Mail Address</label>
                               <v-text-field
                                   solo
                                   v-model="recipientemail"
                                   :rules="[rules.required, rules.email]"
                                   type="email"

                               ></v-text-field>

                           </v-col>

                       </v-row>

                        <v-row dense>
                            <v-col cols="12" sm="2" class="ml-auto">
                                <v-btn :disabled="amount_error" @click="create_card" :loading="progress" rounded x-large  color="purple" dark >Continue <v-icon>mdi-arrow-right</v-icon></v-btn>
                            </v-col>

                        </v-row>
                            </v-timeline-item>
                            </v-form>
                        </v-timeline>


            </div>
        </div>
    </v-col>
</v-row>

</template>

<script>
    export default {
        name: "cardCmponent",
        data(){
            return{
                progress:false,
                step:1,
                amount:5.00,
                currency:'USD',
                address:'',
                amount_error:false,
                city:'',
                name:'',
                sendername:'',
                senderemail:'',
                message:'',
                recipientname:'',
                recipientemail:'',
                rules: {
                    required: value => !!value || 'Required.',
                    counter: value => ((Number(value) >= 5 && Number(value)) <=10000) || 'The amount must be between $5 - $10,000 ',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    }
                    },
                currencies:[
                    {
                    text:'Ghana Cedis(GHS)',
                    value:'GHS'
                } ,
                    {
                    text:'US Dollar(USD)',
                    value:'USD'
                }
                ],
                requiredRules: [
                    v => !!v || 'This field is required',
                    //v => (v && v.length <= 10) || 'Name must be less than 10 characters',
                ],
            }
        },
        methods:{
            check_amount(){
             return  this.amount_error = !!(this.amount && this.amount < 5);
            },
            create_card(){
                if (this.$refs.card_form.validate()){
                this.progress = true;

                let formData = new FormData();
                formData.append('billing_name',this.name);
                formData.append('amount',this.amount);
                formData.append('currency','USD');
                formData.append('sendername',this.sendername);
                formData.append('senderemail',this.senderemail);
                formData.append('message',this.message);
                formData.append('recipientname',this.recipientname);
                formData.append('recipientemail',this.recipientemail);

                axios.post('/api/newcard',formData)
                    .then(res=>{
                        this.progress = false;
                        this.$router.push({
                            path:`/checkoutcard/${res.data.id}`
                        });

                    })
                .catch(res=>{})


            }

            }
        }
    }
</script>

<style scoped>

</style>
