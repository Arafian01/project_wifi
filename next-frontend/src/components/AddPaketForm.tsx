// src/app/components/AddPaketForm.tsx
'use client';

import React, { useState } from 'react';

const AddPaketForm = ({ onAddPaket }) => {
  const [namaPaket, setNamaPaket] = useState('');
  const [harga, setHarga] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    // Validasi input
    if (!namaPaket || !harga) {
      alert('Semua field harus diisi!');
      return;
    }

    // Simulasi data baru
    const newPaket = {
      id: Date.now(),
      nama_paket: namaPaket,
      harga: harga,
      created_at: new Date().toISOString(),
      updated_at: new Date().toISOString(),
    };

    // Kirim data ke parent component
    onAddPaket(newPaket);

    // Reset form
    setNamaPaket('');
    setHarga('');
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
        Simpan
      </button>
    </form>
  );
};

export default AddPaketForm;