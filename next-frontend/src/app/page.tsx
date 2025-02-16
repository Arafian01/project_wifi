// src/app/page.tsx
import Navbar from '@app/components/Navbar';

export default function Home() {
  return (
    <div className="min-h-screen bg-gray-100">
      {/* Navbar */}
      <Navbar />

      {/* Main Content */}
      <main className="p-8">
        <h1 className="text-3xl font-bold text-center text-primary">
          Welcome to Dashboard
        </h1>
      </main>
    </div>
  );
}