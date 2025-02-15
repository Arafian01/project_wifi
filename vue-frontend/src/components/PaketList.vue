<template>
    <div>
      <h1>Daftar Paket</h1>
      <ul>
        <li v-for="paket in pakets" :key="paket.id">
          {{ paket.nama_paket }} - Rp{{ paket.harga }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        pakets: [],
      };
    },
    created() {
      axios.get('http://localhost:8000/api/pakets')
        .then(response => {
          this.pakets = response.data;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    },
  };
  </script>