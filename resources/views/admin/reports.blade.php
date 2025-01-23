<x-sidebar>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Weekly Inventory Report</h2>
        
           <!-- Button to generate PDF -->
           <div class="text-center mb-4">
            <!-- Button to generate PDF, opens in a new tab -->
            <a href="{{ route('generate.report') }}" target="_blank" class="bg-[#002F5B] text-white py-2 px-6 rounded-lg hover:bg-blue-900 transition duration-300">
                Generate Weekly Report PDF
            </a>
        </div>
        

        <div class="relative w-full h-96">
            <canvas id="weeklyChart"></canvas>
        </div>
        <div class="mt-6">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Current Product Quantities</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($weeklyData['product_quantities'] as $productId => $productData)
                    <div class="bg-white shadow-lg rounded-lg p-4 flex items-center justify-between border-l-4 border-blue-950 hover:shadow-xl transition ease-in-out duration-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                                @if($productData['image'])
                                    <img src="{{ $productData['image'] }}" alt="Product Image" class="w-12 h-12 object-cover rounded-full">
                                @else
                                    <span class="text-gray-500">No Image</span>
                                @endif
                            </div>
                            <span class="text-gray-700 font-medium"> {{ $productData['product'] }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-semibold text-gray-900">@if($productData['quantity'] == 0)
                                No Stock
                            @else
                                {{ $productData['quantity'] }} units
                            @endif</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-sidebar>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyData = @json($weeklyData);

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: weeklyData.labels,
            datasets: [
                {
                    label: 'Inventory Added',
                    data: weeklyData.inventory,
                    borderColor: '#2C7D7B', 
                    backgroundColor: 'rgba(44, 125, 123, 0.2)', 
                    fill: true,
                    lineTension: 0.4, 
                    borderWidth: 3, 
                },
                {
                    label: 'Sales Sold',
                    data: weeklyData.sales,
                    borderColor: '#F44336', 
                    backgroundColor: 'rgba(244, 67, 54, 0.2)', 
                    fill: true,
                    lineTension: 0.4, 
                    borderWidth: 3, 
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        color: '#333', 
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333', 
                    },
                    grid: {
                        color: 'rgba(200, 200, 200, 0.1)', 
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                            family: 'Arial, sans-serif',
                        },
                        color: '#333' 
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)', 
                    titleColor: '#fff', 
                    bodyColor: '#fff', 
                    borderColor: '#2C7D7B', 
                    borderWidth: 1
                }
            }
        }
    });
</script>
