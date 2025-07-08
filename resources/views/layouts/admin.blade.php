<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard - Stockify</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @vite('resources/css/app.css')
  <style>
    /* Custom Styling */
    .sidebar {
      background: linear-gradient(135deg, #1E3A8A 0%, #3B82F6 100%);
      width: 250px;
      padding: 20px;
      height: 100vh;
      color: white;
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
      overflow-y: auto;
      z-index: 10;
      transition: all 0.3s ease;
    }

    .sidebar h2 {
      font-size: 1.8rem;
      font-weight: 800;
      margin-bottom: 30px;
      text-align: center;
      position: relative;
      z-index: 1;
      background: linear-gradient(45deg, #FFFFFF, #E0E7FF);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sidebar nav {
      position: relative;
      z-index: 1;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      margin-bottom: 8px;
      font-size: 1rem;
      font-weight: 500;
      color: white;
      text-decoration: none;
      border-radius: 12px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .sidebar a:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateX(5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      border-color: rgba(255, 255, 255, 0.2);
    }

    .sidebar a::after {
      content: '→';
      position: absolute;
      right: 20px;
      opacity: 0;
      transform: translateX(-10px);
      transition: all 0.3s ease;
    }

    .sidebar a:hover::after {
      opacity: 1;
      transform: translateX(0);
    }

    .logout-btn {
      margin-top: 40px;
      background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
      padding: 15px 20px;
      color: white;
      width: 100%;
      text-align: center;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      z-index: 1;
      border: none;
      cursor: pointer;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
    }

    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(220, 38, 38, 0.5);
    }

    .content {
      padding: 30px;
      flex-grow: 1;
      background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);
      min-height: 100vh;
      position: relative;
      margin-left: 250px;
      transition: margin-left 0.3s ease;
    }

    .content::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(59,130,246,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
      opacity: 0.5;
      pointer-events: none;
    }

    /* Toggle Button for Sidebar */
    .toggle-btn {
      display: none;
      position: absolute;
      top: 20px;
      left: 20px;
      background-color: transparent;
      border: none;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
      z-index: 11;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -250px;
        transition: left 0.3s ease;
      }

      .content {
        margin-left: 0;
      }

      .sidebar.active {
        left: 0;
      }

      .toggle-btn {
        display: block;
      }
    }

    @media (max-width: 640px) {
      .sidebar {
        width: 200px;
      }
    }

  </style>
</head>
<body class="bg-gray-100">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Stockify</h2>
      <nav class="space-y-4">
        <a href="{{ route('admin.dashboard') }}" class="block text-white hover:bg-blue-700 rounded">Dashboard</a>
        <a href="{{ route('admin.products.index') }}" class="block text-white hover:bg-blue-700 rounded">Produk</a>
        <a href="{{ route('admin.categories.index') }}" class="block text-white hover:bg-blue-700 rounded">Kategori</a>
        <a href="{{ route('admin.suppliers.index') }}" class="block text-white hover:bg-blue-700 rounded">Supplier</a>
        <a href="{{ route('admin.reports.index') }}" class="block text-white hover:bg-blue-700 rounded">Laporan</a>
      </nav>

      <!-- Logout Button -->
      <form action="{{ route('logout') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="logout-btn">
          <span>Logout</span>
        </button>
      </form>
    </aside>
    
    <!-- Content -->
    <main class="content">
      <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
      @yield('content')
    </main>
  </div>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
      document.querySelector('.content').classList.toggle('active');
    }
  </script>
</body>
</html>
