'use client';

import { useEffect, useState } from 'react';
import { getTransactions, Transaction } from '../lib/localStorageUtils';

export default function Summary() {
  const [transactions, setTransactions] = useState<Transaction[]>([]);

  useEffect(() => {
    setTransactions(getTransactions());
  }, []);

  const income = transactions
    .filter((t) => t.type === 'income')
    .reduce((sum, t) => sum + t.amount, 0);

  const expense = transactions
    .filter((t) => t.type === 'expense')
    .reduce((sum, t) => sum + t.amount, 0);

  const balance = income - expense;

  return (
    <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div className="bg-green-100 p-4 rounded text-center">
        <h3 className="text-green-800 font-bold">Pemasukan</h3>
        <p className="text-green-600">Rp {income.toLocaleString()}</p>
      </div>
      <div className="bg-red-100 p-4 rounded text-center">
        <h3 className="text-red-800 font-bold">Pengeluaran</h3>
        <p className="text-red-600">Rp {expense.toLocaleString()}</p>
      </div>
      <div className="bg-blue-100 p-4 rounded text-center">
        <h3 className="text-blue-800 font-bold">Saldo</h3>
        <p className="text-blue-600">Rp {balance.toLocaleString()}</p>
      </div>
    </div>
  );
}