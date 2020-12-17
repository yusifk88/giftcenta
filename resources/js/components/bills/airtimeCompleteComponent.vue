<template>
<div>
    <v-row>
        <v-col cols="12" sm="6" class="mx-auto">
            <v-card color="success" dark>
                <v-card-text class="text-center">
                    <h1 class="font-weight-thin">Your airtime as a gift was sent.</h1>
                    <h5 class="font-weight-thin">
                        We shot you a mail.
                        <br>
                        Thanks for choosing GiftCenta.
                    </h5>


                    <v-btn rounded color="amber" block dark to="/">Go home</v-btn>

                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</div>

</template>

<script>
    export default {
        name: "airtimeCompleteComponent"
    }
</script>

<style scoped>

</style>
