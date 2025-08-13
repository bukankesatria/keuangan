'use client';

import { useState, useEffect } from 'react';
import TransactionForm from '../components/TransactionForm';
import TransactionList from '../components/TransactionList';
import Summary from '../components/Summary';

export default function Home() {
  const [refresh, setRefresh] = useState(0);

  // Trigger re-render
  const handleRefresh = () => setRefresh((r) => r + 1);

  // Auto-refresh setiap kali localStorage berubah (dari tab lain)
  useEffect(() => {
    const handleStorage = () => setRefresh((r) => r + 1);
    window.addEventListener('storage', handleStorage);
    return () => window.removeEventListener('storage', handleStorage);
  }, []);

  return (
    <main className="min-h-screen bg-gray-50 p-6">
      <div className="max-w-3xl mx-auto">
        <h1 className="text-3xl font-bold text-center mb-6 text-gray-800">
          Catatan Keuangan Saya
        </h1>

        <Summary />
        <TransactionForm onAdd={handleRefresh} />
        <TransactionList onRefresh={handleRefresh} />
      </div>
    </main>
  );
}