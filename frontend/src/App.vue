// Misalnya, di `frontend/src/components/ProductList.vue`
<template>
  <div>
    <h1>Daftar Produk</h1>
    <ul>
      <li v-for="paket in pakets" :key="paket.id">
        {{ paket.name }} - harga {{ paket.harga }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pakets: [],
    };
  },
  created() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      const response = await fetch('http://127.0.0.1:8000/api/paket');
      this.pakets = await response.json();
    },
  },
};
</script>
