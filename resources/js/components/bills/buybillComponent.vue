<template>
    <div>
        <v-row>
            <v-subheader>Your Information</v-subheader>

            <v-col cols="12" sm="12">
                <v-text-field
                    label="Your Name"
                    outlined

                ></v-text-field>

            </v-col>

            <v-col cols="12" sm="12">
                <v-text-field
                    label="Your E-Mail Address"
                    outlined

                ></v-text-field>

            </v-col>
            <v-col cols="12" sm="12">
                <v-text-field
                    label="Recipient's E-Mail Address"
                    outlined

                ></v-text-field>

            </v-col>


            <v-col cols="12" sm="12">
                <v-text-field
                    label="Recipient's Name"
                    outlined

                ></v-text-field>

            </v-col>
        </v-row>
    </div>
</template>

<script>
    export default {
        name: "buybillComponent"
    }
</script>

<style scoped>

</style>
