// src/app/paket/page.tsx
'use client';

import React, { useState, useEffect } from 'react';
import Navbar from '@app/components/Navbar';
import AddPaketForm from '@app/components/AddPaketForm';

const PaketPage = () => {
  const [pakets, setPakets] = useState([]);
  const [showForm, setShowForm] = useState(false);

  // Fetch data dari API
  useEffect(() => {
    const fetchPakets = async () => {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/pakets');
        const data = await response.json();
        setPakets(data);
      } catch (error) {
        console.error('Error fetching pakets:', error);
      }
    };

    fetchPakets();
  }, []);

  // Handler untuk menambahkan data baru
  const handleAddPaket = (newPaket) => {
    setPakets([...pakets, newPaket]);
    setShowForm(false); // Menutup form setelah menambahkan data
  };

  // Handler untuk menghapus data
  const handleDeletePaket = (id) => {
    setPakets(pakets.filter((paket) => paket.id !== id));
  };

  return (
    <div className="min-h-screen bg-gray-100">
      {/* Navbar */}
      <Navbar />

      {/* Main Content */}
      <main className="p-8">
        <h1 className="text-3xl font-bold text-center text-primary mb-8">
          Data Paket
        </h1>

        {/* Card Section */}
        <div className="bg-white p-6 rounded-lg shadow-md mb-8">
          <div className="flex justify-between items-center">
            <h2 className="text-xl font-semibold">Data Paket</h2>
            <button
              onClick={() => setShowForm(!showForm)}
              className="bg-primary text-white px-4 py-2 rounded hover:bg-red-700"
            >
              Tambah Data
            </button>
          </div>

          {/* Form Tambah Data */}
          {showForm && <AddPaketForm onAddPaket={handleAddPaket} />}
        </div>

        {/* Table Section */}
        <div className="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
          <table className="w-full text-left">
            <thead className="border-b">
              <tr>
                <th className="py-2 px-4">No</th>
                <th className="py-2 px-4">Nama Paket</th>
                <th className="py-2 px-4">Harga</th>
                <th className="py-2 px-4">Deskripsi</th>
                <th className="py-2 px-4">Action</th>
              </tr>
            </thead>
            <tbody>
              {pakets.map((paket, index) => (
                <tr key={paket.id} className="border-b">
                  <td className="py-2 px-4">{index + 1}</td>
                  <td className="py-2 px-4">{paket.nama_paket}</td>
                  <td className="py-2 px-4">{paket.harga}</td>
                  <td className="py-2 px-4">-</td>
                  <td className="py-2 px-4 space-x-2">
                    <button className="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700">
                      Edit
                    </button>
                    <button
                      onClick={() => handleDeletePaket(paket.id)}
                      className="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-700"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </main>
    </div>
  );
};

export default PaketPage;