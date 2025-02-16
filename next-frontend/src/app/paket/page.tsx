// src/app/paket/page.tsx
'use client';

import React, { useState, useEffect } from 'react';
import Navbar from '@app/components/Navbar';
import AddPaketForm from '@app/components/AddPaketForm';

const PaketPage = () => {
  const [pakets, setPakets] = useState([]);
  const [showForm, setShowForm] = useState(false);
  const [editingPaket, setEditingPaket] = useState(null);

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
  const handleAddPaket = async (newPaket) => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/pakets', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(newPaket),
      });

      if (!response.ok) {
        throw new Error('Failed to add paket');
      }

      const addedPaket = await response.json();
      setPakets([...pakets, addedPaket]);
      setShowForm(false); // Menutup form setelah menambahkan data
    } catch (error) {
      console.error('Error adding paket:', error);
    }
  };

  // Handler untuk mengedit data
  const handleEditPaket = async (updatedPaket) => {
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/pakets/${updatedPaket.id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(updatedPaket),
      });

      if (!response.ok) {
        throw new Error('Failed to update paket');
      }

      const updatedData = await response.json();
      setPakets(pakets.map((paket) => (paket.id === updatedData.id ? updatedData : paket)));
      setEditingPaket(null); // Menutup mode edit
    } catch (error) {
      console.error('Error updating paket:', error);
    }
  };

  // Handler untuk menghapus data
  const handleDeletePaket = async (id) => {
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/pakets/${id}`, {
        method: 'DELETE',
      });

      if (!response.ok) {
        throw new Error('Failed to delete paket');
      }

      setPakets(pakets.filter((paket) => paket.id !== id));
    } catch (error) {
      console.error('Error deleting paket:', error);
    }
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
              onClick={() => {
                setEditingPaket(null);
                setShowForm(!showForm);
              }}
              className="bg-primary text-white px-4 py-2 rounded hover:bg-red-700"
            >
              Tambah Data
            </button>
          </div>

          {/* Form Tambah/Edit Data */}
          {showForm && (
            <AddPaketForm
              onAddPaket={handleAddPaket}
              onEditPaket={handleEditPaket}
              editingPaket={editingPaket}
            />
          )}
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
                    <button
                      onClick={() => {
                        setEditingPaket(paket);
                        setShowForm(true);
                      }}
                      className="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-700"
                    >
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