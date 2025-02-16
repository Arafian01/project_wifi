// src/app/components/Navbar.tsx
'use client';

import React from 'react';
import Link from 'next/link';

const Navbar = () => {
  return (
    <nav className="bg-primary text-white p-4 flex justify-between items-center">
      {/* Hamburger Menu */}
      <button className="md:hidden text-white text-xl">
        ☰
      </button>

      {/* Menu Items */}
      <div className="hidden md:flex space-x-4">
        <Link href="/" className="hover:text-gray-300">Dashboard</Link>
        <Link href="/pelanggan" className="hover:text-gray-300">Pelanggan</Link>
        <Link href="/tagihan" className="hover:text-gray-300">Tagihan</Link>
        <Link href="/paket" className="hover:text-gray-300">Paket</Link>
        <Link href="/verifikasi-pembayaran" className="hover:text-gray-300">Verifikasi Pembayaran</Link>
      </div>

      {/* Bell Icon */}
      <div className="text-xl">
        <Link href="/notifikasi" className="hover:text-gray-300">🔔</Link>
      </div>
    </nav>
  );
};

export default Navbar;