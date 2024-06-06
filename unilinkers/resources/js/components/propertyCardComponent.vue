<template>
    <div class="property-card mb-3 col-12 col-md-4 col-lg-3 col-xl-2">
        <img :src="property.image_url" alt="Property Image" class="property-image" />
        <h2>{{ property.name }}</h2>
        <p>{{ property.description }}</p>
        <!-- star rating -->
        <div class="d-flex">
            <!-- v-icon -->
            <span class="d-flex">
                <v-icon v-for="i in 5" :key="i" :color="i <= property.rating ? 'yellow' : 'grey'">mdi-star</v-icon>
            </span>
        </div>
    </div>
</template>

  <script>
  export default {
    name: "PropertyList",
    props: {
      property: Object,
    },
  };
  </script>

  <style scoped>
  .property-list {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
  }

  .property-card {
    border: 1px solid #ccc;
    padding: 1rem;
    border-radius: 5px;
    width: calc(33.333% - 1rem);
    box-sizing: border-box;

  }

  /* property card on hover */
    .property-card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

  .property-card h2 {
    margin: 0 0 0.5rem 0;
  }

  .property-card p {
    margin: 0.5rem 0;
  }

    .property-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 1rem;
    }
  </style>
