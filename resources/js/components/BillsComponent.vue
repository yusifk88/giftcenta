<template>
    <div>

<v-card flat>
        <v-tabs
            v-model="tab"
            centered
            icons-and-text
        >
            <v-tabs-slider color="purple"></v-tabs-slider>

            <v-tab href="#tab-1" active-class="purple--text">
                All
                <v-icon large>mdi-format-list-bulleted</v-icon>
            </v-tab>

            <v-tab href="#tab-2" active-class="purple--text">
                Airtime
                <v-icon>mdi-phone</v-icon>
            </v-tab>

            <v-tab href="#tab-3" active-class="purple--text">
                Data Bundle
                <v-icon>mdi-database-plus-outline</v-icon>
            </v-tab>

            <v-tab href="#tab-4" active-class="purple--text">
                Power
                <v-icon>mdi-power-plug</v-icon>
            </v-tab>

            <v-tab href="#tab-5" active-class="purple--text">
                Internet
                <v-icon>mdi-web</v-icon>
            </v-tab>
            <v-tab href="#tab-6" active-class="purple--text">
                Cable
                <v-icon>mdi-television-box</v-icon>
            </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
            <v-tab-item
                value="tab-1"
            >
                <v-skeleton-loader v-if="!bills.length" type="table" ></v-skeleton-loader>
                <v-card flat v-else>
                    <v-row>
                        <v-col cols="12" sm="12">
                            <h2 class="font-weight-light">AIRTIME</h2>
                        </v-col>
                    </v-row>
                    <v-row>

                        <v-col cols="12" sm="3" v-for="bill in bills" :key="bill.id" v-if="bill.is_airtime">
                            <v-card :to="'/paybill/'+bill.item_code+'?type='+bill.short_name+'&country='+bill.country+'&code='+bill.biller_code">
                                <v-card-text>
                                    {{bill.name}}<br>
                                    <small class="text-muted">{{bill.short_name}}</small>
                                </v-card-text>
                            </v-card>

                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="12">
                            <h2 class="font-weight-light">OTHER GIFTS</h2>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="3" v-for="bill in bills" :key="bill.id" v-if="!bill.is_airtime">
                            <v-card :to="'/paybill/'+bill.item_code+'?type='+bill.short_name+'&country='+bill.country+'&code='+bill.biller_code">
                                <v-card-text>
                                    {{bill.name}}<br>
                                    <small class="text-muted">{{bill.short_name}}</small>
                                </v-card-text>
                            </v-card>

                        </v-col>
                    </v-row>
                </v-card>
            </v-tab-item>
        </v-tabs-items>

</v-card>


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

</style>
