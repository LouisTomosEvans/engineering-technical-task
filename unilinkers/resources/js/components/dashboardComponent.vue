<template>
        <div class="row justify-content-center">
            <!-- button toggle date selector -->
            <div class="col-12 d-flex justify-content-between">
                <div>
                    <b><span style="font-size: 1.25rem; color: #28323b;">Available Properties</span></b>
                </div>

                <!-- add property -->
                <div>
                    <v-btn color="primary" @click="showAddPropertyDialog = true">
                        <v-icon>mdi-plus</v-icon>
                        Add Property
                    </v-btn>
                </div>
            </div>
            <div class="col-12 d-flex mt-3">
                <div class="col-12">
                    <div class="property-list d-flex flex-wrap col-12 mt-3" style="gap: 1rem;">
                        <property-card-component v-for="property in appStore.properties" :key="property.id" :property="property" @click="showPropertyDialog = true; appStore.selectProperty(property)"></property-card-component>
                    </div>
                </div>
            </div>
            <v-overlay v-model="showPropertyDialog" style="z-index: 6;">
            </v-overlay>
            <div v-show="showPropertyDialog" class="p-0 col-6" style="border-radius: 0px; position: fixed; z-index: 3; height: 100%; right: 0px; max-width: calc(50% - 60px); z-index: 7; top: 0px;">
                <v-card class="col-12" elevation="0" style="height: 100%; overflow: scroll; border-radius: 0px; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; padding-right: 0px;">
                    <div style="width: 100%; display: flex; padding: 0px; margin: 0px; padding-left: 24px; padding-right: 24px; padding-bottom: 24px; padding-top: 24px;">
                        <div class="col-12 flex-wrap pt-0 pb-0" style="width: 100%; display: flex;">
                            <div class="col-8 flex-wrap" style="height: 100%; width: 100%; padding: 0px; margin: 0px; display: flex;">
                                <!-- square icon back button -->
                                <v-btn
                                    icon
                                    tile
                                    elevation="0"
                                    @click="showPropertyDialog = false"
                                    title="Back"
                                    style="background-color: transparent; height: 45px; width: 45px; border-radius: 4px;"
                                    class="mr-3"
                                >
                                    <v-icon>mdi-arrow-left</v-icon>
                                </v-btn>

                                <div class="p-0 m-0 d-flex flex-wrap" style="align-content: center">
                                    <p class="w-100 m-0" style="font-size: 1rem; font-weight: 700; line-height: 1.25rem">
                                        Back to properties
                                </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <v-divider class="my-6 mt-0" style="min-width: 100%; background-color: #CCDAE7;"></v-divider>
                    <div style="width: 100%; display: flex; padding: 0px; margin: 0px; padding-left: 24px; padding-right: 24px; margin-bottom: 24px;" v-if="appStore.selectedProperty">
                        <div class="d-flex flex-wrap col-12 m-0 p-0 mb-6" style="align-items:stretch;">
                            <!-- show property details -->
                            <div class="d-flex my-3">
                                <v-btn color="primary" @click="setEditProperty" class="mr-1">
                                    <v-icon>mdi-pencil</v-icon>
                                    Edit Property
                                </v-btn>

                                <v-btn color="error" @click="deleteProperty">
                                    <v-icon>mdi-delete</v-icon>
                                    Delete Property
                                </v-btn>
                            </div>

                            <img :src="appStore.selectedProperty.image_url" alt="Property Image" class="property-image" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 1rem;" />
                            <div class="col-12">
                                <h2>{{ appStore.selectedProperty.name }}</h2>
                                <p>{{ appStore.selectedProperty.description }}</p>
                                <!-- star rating -->
                                <div class="d-flex">
                                    <!-- v-icon -->
                                    <span class="d-flex">
                                        <v-icon v-for="i in 5" :key="i" :color="i <= appStore.selectedProperty.rating ? 'yellow' : 'grey'">mdi-star</v-icon>
                                    </span>
                                </div>
                            </div>

                            <!-- divider -->
                            <v-divider class="my-6" style="min-width: 100%; background-color: #CCDAE7;"></v-divider>

                            <!-- list the rooms -->
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-between">
                                    <h3>Property Rooms</h3>

                                    <v-btn color="primary" @click="showAddRoomDialog = true">
                                        <v-icon>mdi-plus</v-icon>
                                        Add Room
                                    </v-btn>

                                </div>
                                <div class="d-flex flex-wrap mt-3">
                                    <!-- room and description -->
                                    <div v-for="room in appStore.selectedProperty.rooms" :key="room.id" class="col-12" style="border: 1px solid #ccc; padding: 1rem; border-radius: 5px; box-sizing: border-box; margin-bottom: 1rem;">
                                        <h4>{{ room.name }}</h4>
                                        <p>{{ room.description }}</p>
                                        <!-- btn to enquire -->
                                        <div class="d-flex">
                                            <v-btn color="primary" elevation="0" @click="setEditRoom(room)" class="mr-1">
                                                Edit
                                            </v-btn>
                                            <v-btn color="error" @click="deleteRoom(room)">
                                                Delete
                                            </v-btn>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </v-card>
            </div>

            <v-overlay v-model="showAddPropertyDialog" style="z-index: 6;" @click:outside="closePropertyDialog()">
            </v-overlay>
            <div v-show="showAddPropertyDialog" class="p-0 col-6" style="border-radius: 0px; position: fixed; z-index: 3; height: 100%; right: 0px; max-width: calc(50% - 60px); z-index: 7; top: 0px;">
                <v-card class="col-12" elevation="0" style="height: 100%; overflow: scroll; border-radius: 0px; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; padding-right: 0px;">
                    <div style="width: 100%; display: flex; padding: 0px; margin: 0px; padding-left: 24px; padding-right: 24px; padding-bottom: 24px; padding-top: 24px;">
                        <div class="col-12 flex-wrap pt-0 pb-0" style="width: 100%; display: flex;">
                            <div class="col-8 flex-wrap" style="height: 100%; width: 100%; padding: 0px; margin: 0px; display: flex;">
                                <!-- square icon back button -->
                                <v-btn
                                    icon
                                    tile
                                    elevation="0"
                                    @click="closePropertyDialog()"
                                    title="Back"
                                    style="background-color: transparent; height: 45px; width: 45px; border-radius: 4px;"
                                    class="mr-3"
                                >
                                    <!-- custom svg back icon -->
                                    <v-icon>mdi-arrow-left</v-icon>
                                    <!-- subtitle below busttom -->
                                </v-btn>

                                <div class="p-0 m-0 d-flex flex-wrap" style="align-content: center">
                                    <p class="w-100 m-0" style="font-size: 1rem; font-weight: 700; line-height: 1.25rem">
                                        Back to properties
                                </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <v-divider class="my-6 mt-0" style="min-width: 100%; background-color: #CCDAE7;"></v-divider>
                    <div style="width: 100%; display: flex; padding: 0px; margin: 0px; padding-left: 24px; padding-right: 24px; margin-bottom: 24px;">
                        <v-form ref="form" v-model="valid" lazy-validation class="col-12">
                            <v-text-field
                                v-model="property.name"
                                :rules="[rules.required]"
                                label="Name"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="property.address"
                                :rules="[rules.required]"
                                label="Address"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="property.town"
                                :rules="[rules.required]"
                                label="Town"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="property.county"
                                :rules="[rules.required]"
                                label="County"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="property.postcode"
                                :rules="[rules.required]"
                                label="Postcode"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="property.image_url"
                                :rules="[rules.required]"
                                label="Image URL"
                                required
                            ></v-text-field>

                            <v-textarea
                                v-model="property.description"
                                :rules="[rules.required]"
                                label="Description"
                                required
                            ></v-textarea>

                            <v-select
                                v-model="property.rating"
                                :items="ratings"
                                :rules="[rules.required]"
                                label="Rating"
                                required
                            ></v-select>

                            <v-btn @click="submit" :disabled="!valid" color="primary" v-if="!editMode">
                                Add Property
                            </v-btn>

                            <v-btn @click="editProperty" :disabled="!valid" color="primary" v-if="editMode">
                                Edit Property
                            </v-btn>
                        </v-form>
                    </div>
                </v-card>
            </div>


            <v-overlay v-model="showAddRoomDialog" style="z-index: 6;" @click:outside="closeRoomDialog()">
            </v-overlay>
            <div v-show="showAddRoomDialog" class="p-0 col-6" style="border-radius: 0px; position: fixed; z-index: 3; height: 100%; right: 0px; max-width: calc(50% - 60px); z-index: 7; top: 0px;">
                <v-card class="col-12" elevation="0" style="height: 100%; overflow: scroll; border-radius: 0px; padding-bottom: 0px; padding-top: 0px; padding-left: 0px; padding-right: 0px;">
                    <div style="width: 100%; display: flex; padding: 0px; margin: 0px; padding-left: 24px; padding-right: 24px; padding-bottom: 24px; padding-top: 24px;">
                        <div class="col-12 flex-wrap pt-0 pb-0" style="width: 100%; display: flex;">
                            <div class="col-8 flex-wrap" style="height: 100%; width: 100%; padding: 0px; margin: 0px; display: flex;">
                                <!-- square icon back button -->
                                <v-btn
                                    icon
                                    tile
                                    elevation="0"
                                    @click="closeRoomDialog()"
                                    title="Back"
                                    style="background-color: transparent; height: 45px; width: 45px; border-radius: 4px;"
                                    class="mr-3"
                                >
                                    <!-- custom svg back icon -->
                                    <v-icon>mdi-arrow-left</v-icon>
                                    <!-- subtitle below busttom -->
                                </v-btn>

                                <div class="p-0 m-0 d-flex flex-wrap" style="align-content: center">
                                    <p class="w-100 m-0" style="font-size: 1rem; font-weight: 700; line-height: 1.25rem">
                                        Back to properties
                                </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <v-divider class="my-6 mt-0" style="min-width: 100%; background-color: #CCDAE7;"></v-divider>
                    <div style="width: 100%; display: flex; padding: 0px; margin: 0px; padding-left: 24px; padding-right: 24px; margin-bottom: 24px;">
                        <v-form ref="form" v-model="valid" lazy-validation class="col-12">
                            <v-text-field
                                v-model="room.name"
                                :rules="[rules.required]"
                                label="Name"
                                required
                            ></v-text-field>

                            <v-textarea
                                v-model="room.description"
                                :rules="[rules.required]"
                                label="Description"
                                required
                            ></v-textarea>

                            <v-btn @click="submitRoom" :disabled="!valid" color="primary" v-if="!editMode">
                                Add Room
                            </v-btn>

                            <v-btn @click="editRoom" :disabled="!valid" color="primary" v-if="editMode">
                                Edit Room
                            </v-btn>
                        </v-form>
                    </div>
                </v-card>
            </div>
        </div>
</template>

<script>
import { useAppStore } from '../store/appStore';
import { useUserStore } from '../store/userStore';
import PropertyCardComponent from './propertyCardComponent.vue';
    export default {
        name: 'DashboardComponent',
        components: {
            PropertyCardComponent,
        },
        setup() {
            const appStore = useAppStore();
            const userStore = useUserStore();
            return {
                appStore,
                userStore,
            }
        },
        mounted() {
            console.log('Component mounted.')

            this.appStore.fetchProperties()
        },
        computed: {
        },
        data(){
            return {
                showPropertyDialog: false,
                showAddPropertyDialog: false,
                showAddRoomDialog: false,

                valid: false,
                property: {
                    name: '',
                    address: '',
                    town: '',
                    county: '',
                    postcode: '',
                    image_url: '',
                    description: '',
                    rating: null,
                },
                room: {
                    name: '',
                    description: '',
                },
                ratings: [1, 2, 3, 4, 5],
                rules: {
                    required: value => !!value || 'Required.',
                },
                editMode: false,
            }
        },
        methods: {
            submit() {
                if (this.$refs.form.validate()) {
                    this.appStore.addProperty(this.property)
                    this.showAddPropertyDialog = false
                    // reset form
                    this.property = {
                        name: '',
                        address: '',
                        town: '',
                        county: '',
                        postcode: '',
                        image_url: '',
                        description: '',
                        rating: null,
                    }
                }
            },
            submitRoom() {
                if (this.$refs.form.validate()) {
                    this.appStore.addRoom(this.room)
                    this.showAddRoomDialog = false
                    // reset form
                    this.room = {
                        name: '',
                        description: '',
                    }
                }
            },
            closePropertyDialog() {
                this.showAddPropertyDialog = false
                this.editMode = false
                this.property = {
                    name: '',
                    address: '',
                    town: '',
                    county: '',
                    postcode: '',
                    image_url: '',
                    description: '',
                    rating: null,
                }
            },
            closeRoomDialog() {
                this.showAddRoomDialog = false
                this.editMode = false
                this.room = {
                    name: '',
                    description: '',
                }
            },
            setEditProperty() {
                this.editMode = true
                this.property = this.appStore.selectedProperty
                this.showAddPropertyDialog = true
            },
            editProperty() {
                if (this.$refs.form.validate()) {
                    this.appStore.editProperty(this.property)
                    this.showAddPropertyDialog = false
                    this.showPropertyDialog = true
                    this.editMode = false
                    // reset form
                    this.property = {
                        name: '',
                        address: '',
                        town: '',
                        county: '',
                        postcode: '',
                        image_url: '',
                        description: '',
                        rating: null,
                    }
                }
            },
            setEditRoom(room) {
                this.editMode = true
                this.room = room
                this.showAddRoomDialog = true
            },
            editRoom() {
                if (this.$refs.form.validate()) {
                    this.appStore.editRoom(this.room)
                    this.showAddRoomDialog = false
                    this.editMode = false
                    this.showPropertyDialog = true
                    // reset form
                    this.room = {
                        name: '',
                        description: '',
                    }
                }
            },
            deleteProperty() {
                this.appStore.deleteProperty(this.appStore.selectedProperty)
                this.showPropertyDialog = false
            },
            deleteRoom(room) {
                this.appStore.deleteRoom(room)
            }
        }
    }
</script>

<style>
</style>
