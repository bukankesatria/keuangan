<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Catatan Keuangan</title>
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 10px;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }
        
        h1 {
            text-align: center;
            color: #ffffffff;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }
        
        h2 {
            color: #ffffffff;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        .form-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .form-group {
            width: 100%;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #ffffffff;
            font-size: 0.9rem;
        }
        
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px; /* Prevents zoom on iOS */
            margin-bottom: 10px;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 15px;
        }
        
        button {
            color: white;
            border: none;
            padding: 14px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            touch-action: manipulation; /* Prevents double-tap zoom */
        }
        
        button:active {
            transform: translateY(1px);
        }
        
        .btn-expense {
            background-color: #e74c3c;
        }
        
        .btn-expense:hover, .btn-expense:active {
            background-color: #c0392b;
        }
        
        .btn-income {
            background-color: #2ecc71;
        }
        
        .btn-income:hover, .btn-income:active {
            background-color: #27ae60;
        }
        
        .summary {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin: 25px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        
        .summary-box {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
        }
        
        .summary-box h3 {
            margin: 0 0 10px 0;
            font-size: 1rem;
            font-weight: 600;
        }
        
        .summary-box p {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
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
        
        /* Mobile-optimized table */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px; /* Ensures table doesn't get too cramped */
        }
        
        th, td {
            padding: 10px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 0.85rem;
        }
        
        th {
            background-color: #3498db;
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }
        
        tr:hover {
            background-color: #f1f1f1;
        }
        
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
            min-width: 60px;
        }
        
        .delete-btn:hover, .delete-btn:active {
            background-color: #c0392b;
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }
        
        .empty-state p {
            margin: 10px 0;
            font-size: 0.9rem;
        }
        
        /* Tablet styles */
        @media (min-width: 576px) {
            .container {
                padding: 25px;
            }
            
            .form-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            
            .summary {
                grid-template-columns: repeat(3, 1fr);
                padding: 20px;
            }
            
            body {
                padding: 20px;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 768px) {
            .form-container {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .button-group {
                grid-column: span 3;
                max-width: 400px;
                margin: 20px auto 0;
            }
            
            th, td {
                padding: 12px;
                font-size: 0.9rem;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
        
        @media (min-width: 992px) {
            .form-container {
                grid-template-columns: repeat(4, 1fr);
            }
            
            .button-group {
                grid-column: span 4;
            }
            
            body {
                padding: 30px;
            }
            
            .container {
                padding: 30px;
            }
        }
        
        /* Touch improvements */
        @media (hover: none) and (pointer: coarse) {
            button {
                padding: 16px;
                font-size: 16px;
            }
            
            .delete-btn {
                padding: 10px 14px;
                font-size: 0.9rem;
                min-width: 70px;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a1a1a;
                color: #e0e0e0;
            }
            
            .container {
                background-color: #2d2d2d;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            }
            
            input, select {
                background-color: #3a3a3a;
                border-color: #555;
                color: #e0e0e0;
            }
            
            .summary {
                background-color: #3a3a3a;
            }
            
            .table-container {
                border-color: #555;
            }
            
            th, td {
                border-color: #555;
            }
            
            tr:hover {
                background-color: #404040;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>💰 Sistem Catatan Keuangan</h1>
        
        <!-- Form Input -->
        <div class="form-container">
            <div class="form-group">
                <label for="date">📅 Tanggal</label>
                <input type="date" id="date" required>
            </div>
            <div class="form-group">
                <label for="type">📋 Jenis</label>
                <select id="type" required>
                    <option value="">Pilih Jenis</option>
                    <option value="income">💰 Pemasukan</option>
                    <option value="expense">💸 Pengeluaran</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">💵 Jumlah (Rp)</label>
                <input type="number" id="amount" placeholder="Masukkan jumlah" required>
            </div>
            <div class="form-group">
                <label for="category">🏷️ Kategori</label>
                <select id="category" required>
                    <option value="">Pilih Kategori</option>
                    <optgroup label="Pemasukan">
                        <option value="gaji">💼 Gaji</option>
                        <option value="bonus">🎁 Bonus</option>
                        <option value="investasi">📈 Investasi</option>
                        <option value="lainnya">📝 Lainnya</option>
                    </optgroup>
                    <optgroup label="Pengeluaran">
                        <option value="makanan">🍽️ Makanan & Minuman</option>
                        <option value="transportasi">🚗 Transportasi</option>
                        <option value="belanja">🛍️ Belanja</option>
                        <option value="tagihan">📄 Tagihan</option>
                        <option value="kesehatan">🏥 Kesehatan</option>
                        <option value="hiburan">🎬 Hiburan</option>
                        <option value="pendidikan">📚 Pendidikan</option>
                        <option value="lainnya">📝 Lainnya</option>
                    </optgroup>
                </select>
            </div>
            <div class="form-group">
                <label for="description">📝 Deskripsi</label>
                <input type="text" id="description" placeholder="Deskripsi transaksi (opsional)">
            </div>
            <div class="button-group">
                <button id="add-income" class="btn-income">➕ Tambah Pemasukan</button>
                <button id="add-expense" class="btn-expense">➖ Tambah Pengeluaran</button>
            </div>
        </div>
        
        <!-- Summary -->
        <div class="summary">
            <div class="summary-box summary-income">
                <h3>💰 Total Pemasukan</h3>
                <p id="total-income">Rp 0</p>
            </div>
            <div class="summary-box summary-expense">
                <h3>💸 Total Pengeluaran</h3>
                <p id="total-expense">Rp 0</p>
            </div>
            <div class="summary-box summary-balance">
                <h3>💳 Saldo</h3>
                <p id="balance">Rp 0</p>
            </div>
        </div>
        
        <!-- Transactions Table -->
        <h2>📊 Riwayat Transaksi</h2>
        <div class="table-container">
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
            <div id="empty-state" class="empty-state" style="display: none;">
                <p>📋 Belum ada transaksi</p>
                <p>Mulai tambahkan transaksi pertama Anda!</p>
            </div>
        </div>
    </div>

    <script>
        // Data transaksi - using in-memory storage instead of localStorage
        let transactions = [];
        
        // DOM elements
        const dateInput = document.getElementById('date');
        const typeInput = document.getElementById('type');
        const amountInput = document.getElementById('amount');
        const categoryInput = document.getElementById('category');
        const descriptionInput = document.getElementById('description');
        const addIncomeBtn = document.getElementById('add-income');
        const addExpenseBtn = document.getElementById('add-expense');
        const transactionsBody = document.getElementById('transactions-body');
        const emptyState = document.getElementById('empty-state');
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
            if (!dateInput.value || !amountInput.value || !categoryInput.value) {
                alert('Mohon lengkapi field yang wajib diisi!');
                return;
            }
            
            const amount = parseFloat(amountInput.value);
            if (amount <= 0) {
                alert('Jumlah harus lebih dari 0!');
                return;
            }
            
            // Create transaction object
            const transaction = {
                id: Date.now(),
                date: dateInput.value,
                type: type,
                amount: amount,
                category: categoryInput.value,
                description: descriptionInput.value || '-'
            };
            
            // Add to transactions array
            transactions.push(transaction);
            
            // Update UI
            renderTransactions();
            updateSummary();
            
            // Reset form
            resetForm();
            
            // Show success message
            showToast(`${type === 'income' ? 'Pemasukan' : 'Pengeluaran'} berhasil ditambahkan!`);
        }
        
        // Show toast message
        function showToast(message) {
            // Simple alert for now - could be enhanced with a proper toast component
            alert(message);
        }
        
        // Render transactions
        function renderTransactions() {
            if (transactions.length === 0) {
                transactionsBody.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }
            
            emptyState.style.display = 'none';
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
                    <td>${transaction.type === 'income' ? '💰 Pemasukan' : '💸 Pengeluaran'}</td>
                    <td>${formatCategory(transaction.category)}</td>
                    <td style="font-weight: bold; color: ${transaction.type === 'income' ? '#2ecc71' : '#e74c3c'}">${formattedAmount}</td>
                    <td>${transaction.description}</td>
                    <td>
                        <button class="delete-btn" data-id="${transaction.id}">🗑️ Hapus</button>
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
                'gaji': '💼 Gaji',
                'bonus': '🎁 Bonus',
                'investasi': '📈 Investasi',
                'makanan': '🍽️ Makanan & Minuman',
                'transportasi': '🚗 Transportasi',
                'belanja': '🛍️ Belanja',
                'tagihan': '📄 Tagihan',
                'kesehatan': '🏥 Kesehatan',
                'hiburan': '🎬 Hiburan',
                'pendidikan': '📚 Pendidikan',
                'lainnya': '📝 Lainnya'
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
                renderTransactions();
                updateSummary();
                showToast('Transaksi berhasil dihapus!');
            }
        }
        
        // Reset form
        function resetForm() {
            amountInput.value = '';
            categoryInput.value = '';
            descriptionInput.value = '';
            typeInput.value = '';
            dateInput.value = today;
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
                    if (option.parentElement && option.parentElement.label === 'Pengeluaran') {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                } else if (value === 'expense') {
                    if (option.parentElement && option.parentElement.label === 'Pemasukan') {
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
        
        // Add some sample data for demonstration
        function addSampleData() {
            const sampleTransactions = [
                {
                    id: 1,
                    date: today,
                    type: 'income',
                    amount: 5000000,
                    category: 'gaji',
                    description: 'Gaji bulan ini'
                },
                {
                    id: 2,
                    date: today,
                    type: 'expense',
                    amount: 150000,
                    category: 'makanan',
                    description: 'Makan siang'
                }
            ];
            
            transactions.push(...sampleTransactions);
            renderTransactions();
            updateSummary();
        }
        
        // Uncomment the line below to add sample data
        // addSampleData();
    </script>
</body>
</html>