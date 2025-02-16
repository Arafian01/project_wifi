import Navbar from '@app/components/Navbar';

export default function Dashboard() {
  return (
    <div className="min-h-screen bg-gray-100">
      <Navbar />
      <div className="p-4">
        <h1 className="text-2xl font-bold text-primary">Welcome to Dashboard</h1>
      </div>
    </div>
  );
}