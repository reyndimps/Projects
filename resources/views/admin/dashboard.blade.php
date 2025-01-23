<x-sidebar> 
    <div class="bg-white py-8">
        <div class="container mx-auto px-4">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-gray-500">Overview of your system's key metrics</p>
            </div>
  
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Active Users -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Active Users</h2>
                            <p class="text-sm text-gray-500">Total registered users</p>
                        </div>
                        <div class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V17M8 11V17M12 11V17M12 6V9" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-4xl font-bold text-gray-900">{{ $user }}</p>
                </div>
  
                <!-- Current Products -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Current Products</h2>
                            <p class="text-sm text-gray-500">Products in inventory</p>
                        </div>
                        <div class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l6-6m0 0l6 6m-6-6v12" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-4xl font-bold text-gray-900">{{ $product }}</p>
                </div>
  
                <!-- Total Suppliers -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Total Suppliers</h2>
                            <p class="text-sm text-gray-500">Partners providing inventory</p>
                        </div>
                        <div class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M9 21h6a2 2 0 002-2v-4a2 2 0 00-2-2h-6a2 2 0 00-2 2v4a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-4xl font-bold text-gray-900">{{ $supplier }}</p>
                </div>
  
                <!-- Inventory Transactions -->
                <div class="bg-white shadow-lg rounded-xl p-6 hover:shadow-2xl transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Inventory Transactions</h2>
                            <p class="text-sm text-gray-500">Recent inventory activity</p>
                        </div>
                        <div class="text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-4xl font-bold text-gray-900">{{ $stockTransaction }}</p>
                </div>
            </div>
  
            <div class="mt-10 bg-white shadow-lg rounded-xl p-6">
              <h2 class="text-xl font-bold text-gray-800">Weekly Sales (Items Sold)</h2>
              <!-- Set a fixed height container for the chart -->
              <div class="mt-6 h-[300px]">
                  <canvas id="weeklySalesChart"></canvas>
              </div>
          </div>
  
        </div>
    </div>
  </x-sidebar>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      // Weekly Sales Data from PHP
      const weekDays = @json($weekDays);
      const salesCounts = @json($salesCounts);
  
      // Initialize Chart
      const ctx = document.getElementById('weeklySalesChart').getContext('2d');
      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: weekDays, // Use the week days (Sunday to Saturday)
              datasets: [{
                  label: 'Items Sold',
                  data: salesCounts,
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false, // Disable the default aspect ratio
              scales: {
                  x: {
                      title: {
                          display: true,
                          text: 'Days of the Week'
                      }
                  },
                  y: {
                      beginAtZero: true,
                      title: {
                          display: true,
                          text: 'Items Sold'
                      }
                  }
              }
          }
      });
  </script>
  