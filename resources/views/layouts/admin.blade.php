<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Dashboard - Stockify</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  @vite('resources/css/app.css')
  <style>
    /* Custom Styling */
    .sidebar {
      background: linear-gradient(180deg, #1e293b 0%, #334155 100%);
      width: 280px;
      padding: 0;
      height: 100vh;
      color: white;
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
      overflow-y: auto;
      z-index: 10;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-header {
      padding: 30px 25px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(255, 255, 255, 0.02);
      backdrop-filter: blur(10px);
    }

    .sidebar h2 {
      font-size: 1.75rem;
      font-weight: 700;
      margin: 0;
      text-align: center;
      background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-shadow: none;
      letter-spacing: -0.5px;
    }

    .sidebar-nav {
      padding: 20px 0;
    }

    .nav-section {
      margin-bottom: 30px;
    }

    .nav-section-title {
      font-size: 0.75rem;
      font-weight: 600;
      color: #94a3b8;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 12px;
      padding: 0 25px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      padding: 14px 25px;
      margin: 2px 15px;
      font-size: 0.95rem;
      font-weight: 500;
      color: #e2e8f0;
      text-decoration: none;
      border-radius: 12px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .sidebar a i {
      font-size: 1.1rem;
      margin-right: 12px;
      width: 20px;
      text-align: center;
      opacity: 0.8;
      transition: all 0.3s ease;
    }

    .sidebar a:hover {
      background: rgba(59, 130, 246, 0.1);
      color: #3b82f6;
      transform: translateX(4px);
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }

    .sidebar a:hover i {
      opacity: 1;
      transform: scale(1.1);
    }

    .sidebar a.active {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .sidebar a.active i {
      opacity: 1;
    }

    .sidebar a::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 3px;
      background: linear-gradient(180deg, #3b82f6 0%, #8b5cf6 100%);
      transform: scaleY(0);
      transition: transform 0.3s ease;
    }

    .sidebar a:hover::before {
      transform: scaleY(1);
    }

    .sidebar a.active::before {
      transform: scaleY(1);
    }

    .logout-section {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }

    .logout-btn {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      padding: 12px 20px;
      color: white;
      width: 100%;
      text-align: center;
      border-radius: 10px;
      font-size: 0.9rem;
      font-weight: 600;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border: none;
      cursor: pointer;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
      position: relative;
    }

    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(239, 68, 68, 0.35);
    }

    .logout-btn i {
      margin-right: 8px;
      font-size: 0.9rem;
    }

    .content {
      padding: 30px;
      flex-grow: 1;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      min-height: 100vh;
      position: relative;
      margin-left: 280px;
      transition: margin-left 0.3s ease;
    }

    .content::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(59,130,246,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
      opacity: 0.7;
      pointer-events: none;
    }

    /* Toggle Button for Sidebar */
    .toggle-btn {
      display: none;
      position: absolute;
      top: 20px;
      left: 20px;
      background: rgba(30, 41, 59, 0.9);
      border: none;
      color: white;
      font-size: 1.2rem;
      cursor: pointer;
      z-index: 11;
      padding: 10px 12px;
      border-radius: 8px;
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }

    .toggle-btn:hover {
      background: rgba(30, 41, 59, 1);
      transform: scale(1.05);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -280px;
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
        width: 260px;
        left: -260px;
      }
    }

    /* Scrollbar Styling */
    .sidebar::-webkit-scrollbar {
      width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    /* Animation for loading */
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .sidebar a {
      animation: slideIn 0.3s ease forwards;
    }

    .sidebar a:nth-child(1) { animation-delay: 0.1s; }
    .sidebar a:nth-child(2) { animation-delay: 0.2s; }
    .sidebar a:nth-child(3) { animation-delay: 0.3s; }
    .sidebar a:nth-child(4) { animation-delay: 0.4s; }
    .sidebar a:nth-child(5) { animation-delay: 0.5s; }

  </style>
</head>
<body class="bg-gray-100">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <h2>Stockify</h2>
      </div>
      
      <nav class="sidebar-nav">
        <div class="nav-section">
          <div class="nav-section-title">Menu Utama</div>
          <a href="{{ route('admin.dashboard') }}" class="block text-white hover:bg-blue-700 rounded active">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
          </a>
          <a href="{{ route('admin.products.index') }}" class="block text-white hover:bg-blue-700 rounded">
            <i class="fas fa-box"></i>
            Produk
          </a>
          <a href="{{ route('admin.categories.index') }}" class="block text-white hover:bg-blue-700 rounded">
            <i class="fas fa-tags"></i>
            Kategori
          </a>
          <a href="{{ route('admin.suppliers.index') }}" class="block text-white hover:bg-blue-700 rounded">
            <i class="fas fa-truck"></i>
            Supplier
          </a>
        </div>
        
        <div class="nav-section">
          <div class="nav-section-title">Laporan</div>
          <a href="{{ route('admin.reports.index') }}" class="block text-white hover:bg-blue-700 rounded">
            <i class="fas fa-chart-line"></i>
            Laporan
          </a>
        </div>
      </nav>

      <!-- Logout Button -->
      <div class="logout-section">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </aside>
    
    <!-- Content -->
    <main class="content">
      <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button>
      @yield('content')
    </main>
  </div>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
      document.querySelector('.content').classList.toggle('active');
    }

    // Set active menu based on current URL
    document.addEventListener('DOMContentLoaded', function() {
      const currentPath = window.location.pathname;
      const menuLinks = document.querySelectorAll('.sidebar a');
      
      menuLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') && currentPath.includes(link.getAttribute('href'))) {
          link.classList.add('active');
        }
      });
    });
  </script>
</body>
</html>