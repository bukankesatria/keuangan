'use client';

import { useEffect, useState } from 'react';
import { getTransactions, Transaction } from '../lib/localStorageUtils';

export default function TransactionList({ onRefresh }: { onRefresh: () => void }) {
  const [transactions, setTransactions] = useState<Transaction[]>([]);

  useEffect(() => {
    setTransactions(getTransactions());
  }, [onRefresh]);

  const handleDelete = (id: string) => {
    const filtered = transactions.filter((t) => t.id !== id);
    localStorage.setItem('transactions', JSON.stringify(filtered));
    setTransactions(filtered);
  };

  return (
    <div className="bg-white p-6 rounded-lg shadow">
      <h2 className="text-xl font-bold mb-4">Riwayat Transaksi</h2>
      {transactions.length === 0 ? (
        <p className="text-gray-500">Belum ada transaksi.</p>
      ) : (
        <ul className="space-y-2">
          {transactions.map((t) => (
            <li
              key={t.id}
              className={`flex justify-between p-3 border-b ${
                t.type === 'income' ? 'text-green-600' : 'text-red-600'
              }`}
            >
              <div>
                <span className="font-medium">{t.description}</span>
                <span className="text-sm text-gray-500 ml-2">({t.date})</span>
              </div>
              <div className="flex items-center">
                <span className="mr-4">Rp {t.amount.toLocaleString()}</span>
                <button
                  onClick={() => handleDelete(t.id)}
                  className="text-red-500 hover:text-red-700 text-sm"
                >
                  Hapus
                </button>
              </div>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}