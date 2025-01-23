<x-sidebar>
    <div class="p-6 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Monthly Sales and Items Sold for the Year</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white shadow-2 border-2 hover:scale-105 duration-500 rounded-lg p-6">
                <canvas id="salesChart" class="w-full"></canvas>
            </div>

            <div class="bg-white shadow-2 border-2 hover:scale-105 duration-500 rounded-lg p-6">
                <canvas id="itemsChart" class="w-full"></canvas>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="mt-8  p-6 bg-white border rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Summary</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white border-2 p-4 rounded-lg shadow hover:scale-105 duration-300">
                    <h3 class="text-lg font-bold text-gray-700">Total Sales</h3>
                    <p id="totalSales" class="text-2xl font-bold text-[#002F5B] mt-2">₱0</p>
                </div>
                <div class="bg-white border-2 p-4 rounded-lg shadow hover:scale-105 duration-300">
                    <h3 class="text-lg font-bold text-gray-700">Items Sold</h3>
                    <p id="totalItems" class="text-2xl font-bold text--[#002F5B] mt-2">0</p>
                </div>
                <div class="bg-white border-2 p-4 rounded-lg shadow hover:scale-105 duration-300">
                    <h3 class="text-lg font-bold text-gray-700">Best Month</h3>
                    <p id="bestMonth" class="text-xl font-bold text--[#002F5B] mt-2">-</p>
                </div>
            </div>
        </div>

    
    </div>
</x-sidebar>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 document.addEventListener('DOMContentLoaded', () => {
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const itemsCtx = document.getElementById('itemsChart').getContext('2d');
    const totalSalesElem = document.getElementById('totalSales');
    const totalItemsElem = document.getElementById('totalItems');
    const bestMonthElem = document.getElementById('bestMonth');
    const topItemsElem = document.getElementById('topItems');

    const loadMonthlyData = async () => {
        try {
            const response = await fetch('/api/monthly-sales');
            const data = await response.json();

            const labels = Object.keys(data);
            const sales = Object.values(data).map(item => parseInt(item.total_sales, 10));
            const items = Object.values(data).map(item => parseInt(item.total_items, 10));

            // Calculate totals and best month
            const totalSales = sales.reduce((acc, val) => acc + val, 0);
            const totalItems = items.reduce((acc, val) => acc + val, 0);
            const bestMonthIndex = sales.length > 0 ? sales.indexOf(Math.max(...sales)) : -1;
            const bestMonth = bestMonthIndex >= 0 ? labels[bestMonthIndex] : 'No Data';

            // Update Summary Section
            totalSalesElem.textContent = `₱${totalSales.toLocaleString()}`;
            totalItemsElem.textContent = totalItems.toLocaleString();
            bestMonthElem.textContent = bestMonth;

            if (sales.length === 0 || items.length === 0) return;

            // Render Sales Chart
            new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{ label: 'Total Sales (₱)', data: sales, backgroundColor: '#002F5B' }],
                },
                options: { responsive: true, scales: { y: { beginAtZero: true } } },
            });

            // Render Items Chart
            new Chart(itemsCtx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{ label: 'Items Sold', data: items, backgroundColor: '#002F5B' }],
                },
                options: { responsive: true, scales: { y: { beginAtZero: true } } },
            });
        } catch (error) {
            console.error('Error loading monthly sales:', error);
        }
    };

    const loadTopItems = async () => {
        try {
            const response = await fetch('/api/top-items');
            const data = await response.json();

            topItemsElem.innerHTML = '';
            data.forEach(item => {
                const li = document.createElement('li');
                li.textContent = `${item.name} - ${item.quantity} sold`;
                li.classList.add('text-gray-700');
                topItemsElem.appendChild(li);
            });
        } catch (error) {
            console.error('Error loading top items:', error);
        }
    };

    // Initialize
    loadMonthlyData();
    loadTopItems();
});

</script>
