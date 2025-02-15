<template>
  <div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <!-- Card Total Pelanggan -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800">Total Pelanggan</h2>
        <p class="text-3xl font-bold text-blue-600 mt-2">{{ totalPelanggan }}</p>
      </div>

      <!-- Card Inisiatif -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800">Inisiatif</h2>
        <p class="text-gray-600 mt-2">Tampilkan grafik atau statistik lainnya.</p>
      </div>

      <!-- Card Lainnya -->
      <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800">Performa Bulanan</h2>
        <p class="text-gray-600 mt-2">Analisis performa bulan ini.</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "AppDashboard",
  data() {
    return {
      totalPelanggan: 0,
    };
  },
  created() {
    axios.get("http://localhost:8000/api/pelanggan/total")
      .then((response) => {
        this.totalPelanggan = response.data.total_pelanggan;
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  },
};
</script>