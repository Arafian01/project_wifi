<template>
    <nav class="bg-blue-600 text-white p-4">
      <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-bold">WiFi Management</div>
        <ul class="flex space-x-4">
          <li><router-link to="/" class="hover:text-blue-200">Dashboard</router-link></li>
          <li><router-link to="/pelanggan" class="hover:text-blue-200">Pelanggan</router-link></li>
          <li><router-link to="/laporan" class="hover:text-blue-200">Laporan</router-link></li>
          <li><router-link to="/tagihan" class="hover:text-blue-200">Tagihan</router-link></li>
          <li><router-link to="/verifikasi-pembayaran" class="hover:text-blue-200">Verifikasi Pembayaran</router-link></li>
        </ul>
        <div class="flex items-center space-x-2">
          <span>Admin</span>
          <img src="https://via.placeholder.com/40" alt="Admin" class="rounded-full" />
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    name: "AppNavbar",
  };
  </script>