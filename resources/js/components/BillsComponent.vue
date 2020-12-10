<template>
    <div>
        <v-row>
            <v-col cols="12" sm="12">
                <h2 class="font-weight-light">AIRTIME</h2>
            </v-col>
        </v-row>
        <v-row>

            <v-col cols="12" sm="3" v-for="bill in bills" :key="bill.id" v-if="bill.is_airtime">
                <v-card link>
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
                <v-card link>
                    <v-card-text>
                        {{bill.name}}<br>
                        <small class="text-muted">{{bill.short_name}}</small>
                    </v-card-text>
                </v-card>

            </v-col>
        </v-row>
    </div>

</template>

<script>
    export default {
        name: "BillsComponent",
        props:['bills']
    }
</script>

<style scoped>

</style>
