<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Catatan Keuangan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .form-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .form-group {
            flex: 1;
            min-width: 250px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        .btn-expense {
            background-color: #e74c3c;
        }
        .btn-expense:hover {
            background-color: #c0392b;
        }
        .btn-income {
            background-color: #2ecc71;
        }
        .btn-income:hover {
            background-color: #27ae60;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .summary {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .summary-box {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            width: 30%;
        }
        .summary-income {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .summary-expense {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .summary-balance {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
            }
            .summary-box {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem Catatan Keuangan</h1>
        
        <!-- Form Input -->
        <div class="form-container">
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" id="date" required>
            </div>
            <div class="form-group">
                <label for="type">Jenis</label>
                <select id="type" required>
                    <option value="">Pilih Jenis</option>
                    <option value="income">Pemasukan</option>
                    <option value="expense">Pengeluaran</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Jumlah (Rp)</label>
                <input type="number" id="amount" placeholder="Masukkan jumlah" required>
            </div>
            <div class="form-group">
                <label for="category">Kategori</label>
                <select id="category" required>
                    <option value="">Pilih Kategori</option>
                    <optgroup label="Pemasukan">
                        <option value="gaji">Gaji</option>
                        <option value="bonus">Bonus</option>
                        <option value="investasi">Investasi</option>
                        <option value="lainnya">Lainnya</option>
                    </optgroup>
                    <optgroup label="Pengeluaran">
                        <option value="makanan">Makanan & Minuman</option>
                        <option value="transportasi">Transportasi</option>
                        <option value="belanja">Belanja</option>
                        <option value="tagihan">Tagihan</option>
                        <option value="kesehatan">Kesehatan</option>
                        <option value="hiburan">Hiburan</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="lainnya">Lainnya</option>
                    </optgroup>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <input type="text" id="description" placeholder="Deskripsi transaksi">
            </div>
            <div class="form-group" style="display: flex; gap: 10px; align-items: flex-end;">
                <button id="add-income" class="btn-income">Tambah Pemasukan</button>
                <button id="add-expense" class="btn-expense">Tambah Pengeluaran</button>
            </div>
        </div>
        
        <!-- Summary -->
        <div class="summary">
            <div class="summary-box summary-income">
                <h3>Total Pemasukan</h3>
                <p id="total-income">Rp 0</p>
            </div>
            <div class="summary-box summary-expense">
                <h3>Total Pengeluaran</h3>
                <p id="total-expense">Rp 0</p>
            </div>
            <div class="summary-box summary-balance">
                <h3>Saldo</h3>
                <p id="balance">Rp 0</p>
            </div>
        </div>
        
        <!-- Transactions Table -->
        <h2>Riwayat Transaksi</h2>
        <table id="transactions-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="transactions-body">
                <!-- Transactions will be added here -->
            </tbody>
        </table>
    </div>

    <script>
        // Data transaksi
        let transactions = JSON.parse(localStorage.getItem('transactions')) || [];
        
        // DOM elements
        const dateInput = document.getElementById('date');
        const typeInput = document.getElementById('type');
        const amountInput = document.getElementById('amount');
        const categoryInput = document.getElementById('category');
        const descriptionInput = document.getElementById('description');
        const addIncomeBtn = document.getElementById('add-income');
        const addExpenseBtn = document.getElementById('add-expense');
        const transactionsBody = document.getElementById('transactions-body');
        const totalIncomeEl = document.getElementById('total-income');
        const totalExpenseEl = document.getElementById('total-expense');
        const balanceEl = document.getElementById('balance');
        
        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
        
        // Event listeners
        addIncomeBtn.addEventListener('click', () => addTransaction('income'));
        addExpenseBtn.addEventListener('click', () => addTransaction('expense'));
        
        // Add transaction function
        function addTransaction(type) {
            // Validate inputs
            if (!dateInput.value || !typeInput.value || !amountInput.value || !categoryInput.value) {
                alert('Mohon lengkapi semua field!');
                return;
            }
            
            // Check if type matches the button clicked
            if (type !== typeInput.value) {
                alert(`Mohon pilih jenis "${type === 'income' ? 'Pemasukan' : 'Pengeluaran'}"`);
                return;
            }
            
            // Create transaction object
            const transaction = {
                id: Date.now(),
                date: dateInput.value,
                type: typeInput.value,
                amount: parseFloat(amountInput.value),
                category: categoryInput.value,
                description: descriptionInput.value || '-'
            };
            
            // Add to transactions array
            transactions.push(transaction);
            
            // Save to localStorage
            saveToLocalStorage();
            
            // Update UI
            renderTransactions();
            updateSummary();
            
            // Reset form
            resetForm();
        }
        
        // Render transactions
        function renderTransactions() {
            transactionsBody.innerHTML = '';
            
            // Sort transactions by date (newest first)
            const sortedTransactions = [...transactions].sort((a, b) => new Date(b.date) - new Date(a.date));
            
            sortedTransactions.forEach(transaction => {
                const row = document.createElement('tr');
                
                // Format date
                const date = new Date(transaction.date);
                const formattedDate = date.toLocaleDateString('id-ID');
                
                // Format amount
                const formattedAmount = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(transaction.amount);
                
                row.innerHTML = `
                    <td>${formattedDate}</td>
                    <td>${transaction.type === 'income' ? 'Pemasukan' : 'Pengeluaran'}</td>
                    <td>${formatCategory(transaction.category)}</td>
                    <td>${formattedAmount}</td>
                    <td>${transaction.description}</td>
                    <td>
                        <button class="delete-btn" data-id="${transaction.id}">Hapus</button>
                    </td>
                `;
                
                transactionsBody.appendChild(row);
            });
            
            // Add event listeners to delete buttons
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', (e) => {
                    const id = parseInt(e.target.getAttribute('data-id'));
                    deleteTransaction(id);
                });
            });
        }
        
        // Format category name
        function formatCategory(category) {
            const labels = {
                'gaji': 'Gaji',
                'bonus': 'Bonus',
                'investasi': 'Investasi',
                'makanan': 'Makanan & Minuman',
                'transportasi': 'Transportasi',
                'belanja': 'Belanja',
                'tagihan': 'Tagihan',
                'kesehatan': 'Kesehatan',
                'hiburan': 'Hiburan',
                'pendidikan': 'Pendidikan',
                'lainnya': 'Lainnya'
            };
            return labels[category] || category;
        }
        
        // Update summary
        function updateSummary() {
            const totalIncome = transactions
                .filter(t => t.type === 'income')
                .reduce((sum, t) => sum + t.amount, 0);
            
            const totalExpense = transactions
                .filter(t => t.type === 'expense')
                .reduce((sum, t) => sum + t.amount, 0);
            
            const balance = totalIncome - totalExpense;
            
            totalIncomeEl.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(totalIncome);
            
            totalExpenseEl.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(totalExpense);
            
            balanceEl.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(balance);
        }
        
        // Delete transaction
        function deleteTransaction(id) {
            if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                transactions = transactions.filter(t => t.id !== id);
                saveToLocalStorage();
                renderTransactions();
                updateSummary();
            }
        }
        
        // Reset form
        function resetForm() {
            amountInput.value = '';
            categoryInput.value = '';
            descriptionInput.value = '';
            dateInput.value = today;
            typeInput.value = '';
        }
        
        // Save to localStorage
        function saveToLocalStorage() {
            localStorage.setItem('transactions', JSON.stringify(transactions));
        }
        
        // Initialize
        renderTransactions();
        updateSummary();
        
        // Update category options based on transaction type
        typeInput.addEventListener('change', function() {
            const value = this.value;
            const options = categoryInput.options;
            
            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                if (value === 'income') {
                    if (option.parentElement.label === 'Pengeluaran') {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                } else if (value === 'expense') {
                    if (option.parentElement.label === 'Pemasukan') {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                } else {
                    option.disabled = false;
                }
            }
            
            // Reset category if current selection is invalid
            if ((value === 'income' && ['makanan', 'transportasi', 'belanja', 'tagihan', 'kesehatan', 'hiburan', 'pendidikan'].includes(categoryInput.value)) ||
                (value === 'expense' && ['gaji', 'bonus', 'investasi'].includes(categoryInput.value))) {
                categoryInput.value = '';
            }
        });
    </script>
</body>
</html>