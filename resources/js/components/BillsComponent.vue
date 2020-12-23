<template>
    <div>

        <v-row>
            <v-col cols="12" sm="6">
                <v-hover v-slot="{ hover }">
                <v-card link to="/buyairtime">
                    <v-img
                    src="/img/airtime.jpg"
                    ></v-img>
                    <v-expand-transition>
                        <div
                            v-if="hover"
                            class="d-flex transition-fast-in-fast-out amber darken-2 v-card--reveal display-3 white--text"
                            style="height: 100%;"
                        >
                            <v-btn to="/buyairtime" color="amber" depressed dark large>Buy Now! <v-icon>mdi-cart-plus</v-icon></v-btn>
                        </div>
                    </v-expand-transition>

                    <v-card-text  style="position: relative;">
                        <v-btn
                            absolute
                            color="amber"
                            class="white--text"
                            fab
                            large
                            right
                            top
                            v-if="!hover"
                        >
                            <v-icon>mdi-cart-plus</v-icon>
                        </v-btn>
                        <center>
                        <h3 :dark="hover">Buy Airtime</h3>
                        </center>
                        Buy airtime for all networks as a gift for a loved one.
                    </v-card-text>
                </v-card>
                </v-hover>
            </v-col>


<!--            <v-col cols="12" sm="6">-->
<!--                <v-hover v-slot="{ hover }">-->

<!--                <v-card to="/buydstv">-->
<!--                    <v-img-->
<!--                    src="/img/dstv.jpg"-->
<!--                    ></v-img>-->
<!--                    <v-expand-transition>-->
<!--                        <div-->
<!--                            v-if="hover"-->
<!--                            class="d-flex transition-fast-in-fast-out amber darken-2 v-card&#45;&#45;reveal display-3 white&#45;&#45;text"-->
<!--                            style="height: 100%;"-->
<!--                        >-->
<!--                            <v-btn to="/buydstv" color="amber" depressed dark large>Buy Now!<v-icon>mdi-cart-plus</v-icon></v-btn>-->
<!--                        </div>-->
<!--                    </v-expand-transition>-->
<!--                    <v-card-text style="position: relative;">-->
<!--                        <v-btn-->
<!--                            absolute-->
<!--                            color="amber"-->
<!--                            class="white&#45;&#45;text"-->
<!--                            fab-->
<!--                            large-->
<!--                            right-->
<!--                            top-->
<!--                            v-if="!hover"-->

<!--                        >-->
<!--                            <v-icon>mdi-cart</v-icon>-->
<!--                        </v-btn>-->
<!--                        <center>-->
<!--                        <h3>Pay TV Bill</h3>-->
<!--                        </center>-->
<!--                        Pay DStv, StartTime and Gotv Bills for a loved one.-->
<!--                    </v-card-text>-->
<!--                </v-card>-->
<!--                </v-hover>-->
<!--            </v-col>-->
        </v-row>


    </div>

</template>

<script>
    export default {
        name: "BillsComponent",
        props:['bills'],
        data(){
            return{
                tab:'tab-1',

            }
        }
    }
</script>

<style scoped>
    .v-card--reveal {
        align-items: center;
        bottom: 0;
        justify-content: center;
        position: absolute;
        width: 100%;
    }
</style>
