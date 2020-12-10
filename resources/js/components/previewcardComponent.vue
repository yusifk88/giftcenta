<template>
<div>
    <v-row>
        <v-col cols="4" class="mx-auto">
            <div class="card">
                <div class="card-body">
                    <v-skeleton-loader type="card" v-if="progress"></v-skeleton-loader>
                    <div v-else class="card virtual-card" :class="color_class">
                        <div class="card-body">
                            <v-row>
                                <v-col cols="12" sm="8" class="text-white font-weight-bold">
                                    {{card.currency+" "+card.amount}}
                                </v-col>
                                <v-col cols="12" sm="4">
                                   <v-img
                                    :src="logo"
                                    height="45"
                                   ></v-img>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" sm="12" class="text-center  text-white">
                                    <h1 class="font-weight-bold">{{card_number}}</h1>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" sm="8" class="text-white font-weight-bold">
                                    {{card.billing_name}}
                                </v-col>

                                <v-col cols="12" sm="4" class="text-white text-right font-weight-bold">
                                    {{card.expiry_date}}<br>
                                    <small>Expires</small>
                                </v-col>

                            </v-row>



                        </div>
                    </div>
                    <v-row>
                        <v-col cols="12" sm="12">
                            <v-list>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title><strong>{{card.recipientname}}</strong></v-list-item-title>
                                    <v-list-item-subtitle>For</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title><strong>{{card.recipientemail}}</strong></v-list-item-title>
                                    <v-list-item-subtitle>{{card.recipientname}}'s E-mail address</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title><strong>{{card.cvv}}</strong></v-list-item-title>
                                    <v-list-item-subtitle>CVV</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title><strong>{{card.message ? card.message : 'No message provided'}}</strong></v-list-item-title>
                                    <v-list-item-subtitle>Your Message</v-list-item-subtitle>
                                    </v-list-item-content>
                                </v-list-item>

                            </v-list>


                            <v-btn color="green" dark block large>Send card to {{card.recipientname}} <v-icon>mdi-send</v-icon></v-btn>
                        </v-col>
                    </v-row>
                </div>
            </div>
        </v-col>
    </v-row>

</div>


</template>

<script>

    export default {
        name: "previewcardComponent",
        data(){
            return{
                card:null,
                progress:true,
            }
        },
        computed:{
          color_class(){
              return this.card.vendor_name === 'visa' ? 'orange_bg' : 'blue_bg';
          },
            logo(){
                return this.card.vendor_name === 'visa' ? '/img/visa.png' : '/img/mastercard.png';
            },
            card_number(){

                    let formattedText = this.card.number.split(' ').join('');
                    if (formattedText.length <= 16) {
                        if (formattedText.length > 0) {
                            formattedText = formattedText.match(new RegExp('.{1,4}', 'g')).join(' ');
                        }
                    } else {
                        alert("plz stop here")
                    }
                    return formattedText;

            }
        },
        methods:{
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
