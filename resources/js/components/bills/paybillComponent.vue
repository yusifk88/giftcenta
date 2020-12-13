<template>
<div>
    <v-row>
        <v-col cols="12" sm="6" class="pt-5">
           <div class="card mt-5">
               <div class="card-body">
                   <center>
                   <h2 class="font-weight-thin">Verify the recipient's {{$route.query.type}} number to continue</h2>
                        <h1><country-flag :country='$route.query.country' size='big'/> {{$route.query.country}}</h1>
                   </center>
                   <v-row>
                       <v-col cols="12" sm="12">
                           <v-form ref="varify_form">
                           <v-text-field
                               v-model="customer_number"
                               :rules="[rules.required]"
                            type="text"
                            label="Number"
                            outlined
                            persistent-hint
                            hint="Enter a phone number if you are buying airtime or DSTV number if you are paying a DSTV bill"
                           ></v-text-field>
                           </v-form>
                       </v-col>

                       <v-col cols="12" sm="12">
                           <v-btn @click="verify()" block color="purple" dark rounded>Verify and continue <v-icon>mdi-arrow-right</v-icon></v-btn>
                       </v-col>

                   </v-row>

               </div>
           </div>
        </v-col>
        <v-col cols="12" sm="6">
                <v-carousel cycle :show-arrows="false" :hide-delimiters=true>
                    <v-carousel-item
                        v-for="(item,i) in designs"
                        :key="i"
                        :src="item.src"

                    ></v-carousel-item>
                </v-carousel>
        </v-col>
    </v-row>
</div>


</template>

<script>
    import CountryFlag from 'vue-country-flag';

    export default {
        name: "paybillComponent",
        components:{
            CountryFlag
        },
        data(){
            return{
                customer_number:'',
                progress:true,
                rules: {
                    required: value => !!value || 'Required.',
                    counter: value => ((Number(value) >= 5 && Number(value)) <=10000) || 'The amount must be between $5 - $10,000 ',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    }
                },
                designs: [
                    {
                        src: '/img/data.jpg',
                    },
                    {
                        src: '/img/dstv.jpg',
                    },
                    {
                        src: '/img/airtime.jpg',
                    },

                ],
            }
        },
        methods:{
            verify(){

                if (this.$refs.varify_form.validate()){
                    let formdata = new FormData();
                    formdata.append('item_code',this.$route.params.id);
                    formdata.append('code',this.$route.query.code);
                    formdata.append('customer',this.customer_number);
                    axios.post('/api/varifybill',formdata)
                        .then(res=>{

                        })
                        .catch(error=>{

                        });


                }

            }
        },
        mounted() {


        }
    }
</script>

<style scoped>

</style>
