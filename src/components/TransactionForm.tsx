'use client';

import { useState } from 'react';
import { saveTransactions, getTransactions, Transaction } from '../lib/localStorageUtils';

export default function TransactionForm({ onAdd }: { onAdd: () => void }) {
  const [amount, setAmount] = useState('');
  const [type, setType] = useState<'income' | 'expense'>('income');
  const [description, setDescription] = useState('');

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!amount || isNaN(Number(amount)) || !description.trim()) return;

    const newTransaction: Transaction = {
      id: Date.now().toString(),
      amount: Number(amount),
      type,
      description: description.trim(),
      date: new Date().toISOString().split('T')[0],
    };

    const transactions = getTransactions();
    saveTransactions([newTransaction, ...transactions]);
    setAmount('');
    setDescription('');
    onAdd(); // refresh data
  };

  return (
    <form onSubmit={handleSubmit} className="bg-white p-6 rounded-lg shadow mb-6">
      <h2 className="text-xl font-bold mb-4">Tambah Transaksi</h2>
      <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <input
          type="number"
          placeholder="Jumlah"
          value={amount}
          onChange={(e) => setAmount(e.target.value)}
          className="border p-2 rounded"
          required
        />
        <select
          value={type}
          onChange={(e) => setType(e.target.value as 'income' | 'expense')}
          className="border p-2 rounded"
        >
          <option value="income">Pemasukan</option>
          <option value="expense">Pengeluaran</option>
        </select>
        <input
          type="text"
          placeholder="Keterangan"
          value={description}
          onChange={(e) => setDescription(e.target.value)}
          className="border p-2 rounded"
          required
        />
      </div>
      <button
        type="submit"
        className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
      >
        Tambah
      </button>
    </form>
  );
}