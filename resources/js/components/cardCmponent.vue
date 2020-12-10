<template>

<v-row>
    <v-col cols="12" sm="8" class="mx-auto">
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
                         <v-col cols="12" sm="6">
                               <label>Amount <sup class="red--text">*</sup></label>
                               <v-text-field
                                   type="number"
                                   :prefix="currency"
                                   solo
                                   v-model="amount"
                                   :rules="requiredRules"

                               ></v-text-field>
                           </v-col>


                           <v-col cols="12" sm="6">
                               <label>Name on Card<sup class="red--text">*</sup></label>
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
                           <v-col cols="12" sm="6">
                               <label>Your E-Mail Address</label>
                               <v-text-field
                                   solo
                                   v-model="senderemail"
                                   :rules="requiredRules"
                                   type="email"

                               ></v-text-field>

                           </v-col>


                           <v-col cols="12" sm="6">
                               <label>Your Message</label>
                               <v-textarea
                                   solo
                                   v-model="message"
                                   :rules="requiredRules"
                                   auto-grow
                                   rows="2"
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
                           <v-col cols="12" sm="6">
                               <label>E-Mail Address</label>
                               <v-text-field
                                   solo
                                   v-model="recipientemail"
                                   :rules="requiredRules"
                                   type="email"

                               ></v-text-field>

                           </v-col>

                       </v-row>

                        <v-row dense>
                            <v-col cols="12" sm="2" class="ml-auto">
                                <v-btn @click="create_card" :loading="progress" rounded x-large  color="purple" dark >Continue <v-icon>mdi-arrow-right</v-icon></v-btn>
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
                city:'',
                name:'',
                sendername:'',
                senderemail:'',
                message:'',
                recipientname:'',
                recipientemail:'',
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
