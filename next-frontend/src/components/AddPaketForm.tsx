// src/app/components/AddPaketForm.tsx
'use client';

import React, { useState, useEffect } from 'react';

const AddPaketForm = ({ onAddPaket, onEditPaket, editingPaket }) => {
  const [namaPaket, setNamaPaket] = useState('');
  const [harga, setHarga] = useState('');

  // Reset form jika tidak dalam mode edit
  useEffect(() => {
    if (editingPaket) {
      setNamaPaket(editingPaket.nama_paket);
      setHarga(editingPaket.harga);
    } else {
      setNamaPaket('');
      setHarga('');
    }
  }, [editingPaket]);

  const handleSubmit = (e) => {
    e.preventDefault();

    // Validasi input
    if (!namaPaket || !harga) {
      alert('Semua field harus diisi!');
      return;
    }

    const paketData = {
      nama_paket: namaPaket,
      harga: harga,
    };

    if (editingPaket) {
      // Mode edit
      onEditPaket({ ...paketData, id: editingPaket.id });
    } else {
      // Mode tambah
      onAddPaket(paketData);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="mt-4">
      <div className="mb-4">
        <label className="block text-sm font-medium mb-2">Nama Paket</label>
        <input
          type="text"
          value={namaPaket}
          onChange={(e) => setNamaPaket(e.target.value)}
          className="w-full px-3 py-2 border rounded"
          placeholder="Masukkan nama paket"
        />
      </div>
      <div className="mb-4">
        <label className="block text-sm font-medium mb-2">Harga</label>
        <input
          type="number"
          value={harga}
          onChange={(e) => setHarga(e.target.value)}
          className="w-full px-3 py-2 border rounded"
          placeholder="Masukkan harga"
        />
      </div>
      <button
        type="submit"
        className="bg-primary text-white px-4 py-2 rounded hover:bg-red-700"
      >
        {editingPaket ? 'Simpan Perubahan' : 'Simpan'}
      </button>
    </form>
  );
};

export default AddPaketForm;