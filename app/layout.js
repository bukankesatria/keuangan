import './globals.css'

export const metadata = {
  title: 'Sistem Pencatat Keuangan',
  description: 'Aplikasi untuk mencatat pemasukan dan pengeluaran',
}

export default function RootLayout({ children }) {
  return (
    <html lang="id">
      <body>
        <div className="min-h-screen bg-gray-50">
          <header className="bg-white shadow-sm border-b">
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div className="flex justify-between items-center h-16">
                <h1 className="text-xl font-semibold text-gray-900">
                  💰 Sistem Keuangan
                </h1>
                <div className="text-sm text-gray-500">
                  {new Date().toLocaleDateString('id-ID')}
                </div>
              </div>
            </div>
          </header>
          
          <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {children}
          </main>
        </div>
      </body>
    </html>
  )
}