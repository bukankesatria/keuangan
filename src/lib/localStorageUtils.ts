export const saveTransactions = (transactions: Transaction[]) => {
  localStorage.setItem('transactions', JSON.stringify(transactions));
};

export const getTransactions = (): Transaction[] => {
  const saved = localStorage.getItem('transactions');
  return saved ? JSON.parse(saved) : [];
};

export interface Transaction {
  id: string;
  amount: number;
  type: 'income' | 'expense';
  description: string;
  date: string;
}