import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useAppStore = defineStore('app', {
    state: () => ({
        properties: [],
        selectedProperty: null,
    }),
    actions: {
        async fetchProperties() {
            const api_url = '/api/properties';
            const response = await axios.get(api_url);
            this.properties = response.data;
        },
        selectProperty(property) {
            this.selectedProperty = property;
            // fetch rooms for the selected property
            this.fetchRooms(property.id);
        },
        async fetchRooms(propertyId) {
            const api_url = `/api/rooms/${propertyId}`;
            const response = await axios.get(api_url);
            this.selectedProperty.rooms = response.data;
        },
        addProperty(property) {
            const api_url = `/api/properties`;
            axios.post(api_url, property)
                .then(response => {
                    this.properties.push(response.data);
                });
        },
        editProperty(property) {
            const api_url = `/api/properties/${property.id}`;
            axios.put(api_url, property)
                .then(response => {
                    const index = this.properties.findIndex(p => p.id === property.id);
                    this.properties[index] = response.data;
                    // select the edited property
                    this.selectProperty(response.data);
                });
        },
        addRoom(room) {
            // add the property id to the room object
            room.property_id = this.selectedProperty.id;
            const api_url = `/api/rooms`;
            axios.post(api_url, room)
                .then(response => {
                    this.selectedProperty.rooms.push(response.data);
                });
        },
        editRoom(room) {
            const api_url = `/api/rooms/${room.id}`;
            axios.put(api_url, room)
                .then(response => {
                    const index = this.selectedProperty.rooms.findIndex(r => r.id === room.id);
                    this.selectedProperty.rooms[index] = response.data;
                });
        },
        deleteProperty(property) {
            const api_url = `/api/properties/${property.id}`;
            axios.delete(api_url)
                .then(() => {
                    const index = this.properties.findIndex(p => p.id === property.id);
                    this.properties.splice(index, 1);
                    this.selectedProperty = null;
                });
        },
        deleteRoom(room) {
            const api_url = `/api/rooms/${room.id}`;
            axios.delete(api_url)
                .then(() => {
                    const index = this.selectedProperty.rooms.findIndex(r => r.id === room.id);
                    this.selectedProperty.rooms.splice(index, 1);
                });
        }
    },
})
