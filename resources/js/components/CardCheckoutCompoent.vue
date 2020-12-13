<template>
    <div>
    <v-row>
        <v-col cols="12" sm="5" class="mx-auto">


                   <v-row>
                       <v-col cols="12" sm="12">
                           <v-skeleton-loader type="card" v-if="progress"></v-skeleton-loader>

                            <div v-else class="card virtual-card" :class="color_class">
                                <div class="card-body">
                                    <v-row>
                                        <v-col cols="8" sm="8" class="text-white">
                                            {{card.currency+" "+card.amount}}
                                        </v-col>
                                        <v-col cols="4" sm="4">
                                            <v-carousel contain @change="change_color()" height="45" vertical cycle :show-arrows="false" :hide-delimiters=true>
                                                <v-carousel-item
                                                    v-for="(item,i) in logos"
                                                    :key="i"
                                                    :src="item.src"
                                                    contain
                                                ></v-carousel-item>
                                            </v-carousel>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col cols="12" sm="12" class="text-center  text-white">
                                            <h1 class="font-weight-bold">#### #### #### ####</h1>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col cols="8" sm="8" class="text-white">
                                            {{card.billing_name}}
                                        </v-col>

                                        <v-col cols="4" sm="4" class="text-white text-right">
                                            ##/##<br>
                                            <small>Expires</small>
                                        </v-col>

                                    </v-row>
                                </div>
                            </div>

                       </v-col>
                   </v-row>
            <v-card tile>
                <v-card-text>
            <v-row>
                       <v-col cols="12" sm="12" style="color:#000" class="py-4">

                           <v-skeleton-loader v-if="progress" type="listitem@7"></v-skeleton-loader>
                          <div v-else>
                           <h2 class="font-weight-thin">Your gift card for {{card.billing_name}} is ready.</h2>
                            <strong>Amount:</strong> {{card.currency}}{{card.amount}}<br>
                            <strong>Service Charge:</strong> {{card.currency}}4<br>
                            <strong>Message:</strong> {{card.message}}<br>
                            <strong>Recipient Email:</strong> {{card.recipientemail}}<br>

                          <p></p>
                               <h2 class="font-weight-bold">Amount Due: {{card.currency}}{{amount}}</h2>
                               <br>
                               <v-btn block v-if="card.created === 0" color="success" large @click="makePayment">Checkout now</v-btn>
                               <v-btn block v-else color="success" large text :to="'/previewcard/'+$route.params.id" >Preview and send card</v-btn>

                          </div>
                       </v-col>
                   </v-row>

                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
    <v-overlay v-if="creating_card" style="z-index: 99;">
        <v-progress-circular size="70" color="purple" indeterminate></v-progress-circular>
    </v-overlay>
    </div>
</template>

<script>
    export default {
        name: "CardCheckoutCompoent",
        data(){
            return{
                creating_card:false,
                color_class:'orange_bg',
                progress:true,
                card:null,
                logos: [
                    {
                        src: '/img/logo.png',
                    },
                    {
                        src: '/img/logo.png',
                    },

                ],
            }
        },
        computed:{
          amount(){
              return Number(this.card.amount) + 4;
          }
        },
        methods:{
            makePayment() {
               let f =  this.$launchFlutterwave({
                    tx_ref: Date.now()+"_virtual_card",
                    amount: this.amount,
                    currency: 'USD',
                    payment_options: 'card,mobilemoney,ussd',
                   redirect_url:'/buycard/'+this.card.id,
                    customer: {
                        email: this.card.senderemail,
                        name: this.card.sendername
                    },
                    callback: function(data) {
                        alert("done paying");
                        this.creating_card=true;
                            axios.get('/api/buycard/'+this.$route.params.id)
                                .then(res=>{
                                    this.creating_card=false;
                                });


                        return false;
                    },
                    customizations: {
                        title: 'Pay for virtual card worth USD'+ this.card.amount +' for '+this.card.recipientname,
                        logo: '/img/logo.png'
                    }
                });

               console.log(f);
            },

            change_color(){
              if (this.color_class === 'orange_bg'){
                  this.color_class = "blue_bg";
              }else {

                  this.color_class = 'orange_bg';
              }


              },
            get_card(){
                this.progress =true;
                axios.get(`/api/card/${this.$route.params.id}`)
                    .then(res=>{
                        this.progress= false;

                        this.card = res.data;
                    })
                .catch(err=>{

                })

            }
        },
        mounted() {
            this.get_card();
        }
    }
</script>

<style scoped>
    .orange_bg{
     background-color: #F6A522;
    }


    .virtual-card{
        transition: 0.5s ease-in-out;
        color:#fff;
        box-shadow: 2px -6px 25px 0 rgba(69,65,78,.1);
    }
    .blue_bg{
        background-color:#001E4C;
    }
</style>
