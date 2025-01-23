<x-layoutstaff>
  <!-- component -->
<div class="container mx-auto bg-white">
  <div x-data="posSystem()" class="flex lg:flex-row flex-col-reverse shadow-lg">
    <!-- left section -->
    <div class="w-full lg:w-3/5 min-h-screen shadow-lg">
      <!-- header -->
      <div class="flex flex-row justify-between items-center px-5 mt-5">
        <div class="text-[#002F5B]">
          <div class="font-bold text-xl">Akina Computer Parts and Accessories Shop</div>
          <span class="text-sm">Total Products: {{ $productcount}}</span>
        </div>
        <div class="flex items-center">
          <div class="text-sm text-center mr-4">
            <div class="w-full max-w-sm min-w-[200px]">
              <form action="" class="flex items-center">
                <label for="{{route('user.dashboard')}}" method="GET" class="sr-only">Search</label>
                  <div class="relative">
                    <input
                      name="search"
                      class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                      placeholder="Search For Products" 
                      value="{{ $search }}"
                    />
                    <button class="absolute top-1 right-1 flex items-center rounded bg-[#002F5B] py-1 px-2.5 border duration-500 border-transparent text-center text-sm text-white transition-all shadow-sm active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                      </svg>
                      Search
                    </button> 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- end header -->
     <!-- categories -->
     <div class="mt-5 flex flex-wrap gap-2 px-5">
      <a href="{{ route('user.dashboard', ['category' => 'all']) }}" 
        class="px-5 py-1 rounded-2xl text-sm font-semibold 
        {{ $category === 'all' ? 'bg-[#002F5B] text-white' : 'text-[#002F5B] hover:bg-gray-200' }}">
          All Items
      </a>
      <a href="{{ route('user.dashboard', ['category' => 'Processors (CPUs)']) }}" 
        class="px-2 py-1 rounded-2xl text-sm font-semibold 
        {{ $category === 'Processors (CPUs)' ? 'bg-[#002F5B] text-white' : 'text-[#002F5B] hover:bg-gray-200' }}">
        Processors
      </a>
      <a href="{{ route('user.dashboard', ['category' => 'Power Supplies (PSUs)']) }}" 
        class="px-2 py-1 rounded-2xl text-sm font-semibold 
        {{ $category === 'Power Supplies (PSUs)' ? 'bg-[#002F5B] text-white' : 'text-[#002F5B] hover:bg-gray-200' }}">
        Power Supplies 
      </a>
      <a href="{{ route('user.dashboard', ['category' => 'Graphics Cards (GPUs)']) }}" 
        class="px-2 py-1 rounded-2xl text-sm font-semibold 
        {{ $category === 'Graphics Cards (GPUs)' ? 'bg-[#002F5B] text-white' : 'text-[#002F5B] hover:bg-gray-200' }}">
        Graphics Cards
      </a>
      <a href="{{ route('user.dashboard', ['category' => 'Memory (RAM)']) }}" 
        class="px-2 py-1 rounded-2xl text-sm font-semibold 
        {{ $category === 'Memory (RAM)' ? 'bg-[#002F5B] text-white' : 'text-[#002F5B] hover:bg-gray-200' }}">
        Memory
      </a>
      <a href="{{ route('user.dashboard', ['category' => 'Motherboards']) }}" 
        class="px-2 py-1 rounded-2xl text-sm font-semibold 
        {{ $category === 'Motherboards' ? 'bg-[#002F5B] text-white' : 'text-[#002F5B] hover:bg-gray-200' }}">
        Motherboards
      </a>
      <a href="{{ route('user.dashboard', ['category' => 'Accessories']) }}" 
        class="px-2 py-1 rounded-2xl text-sm font-semibold 
        {{ $category === 'Accessories' ? 'bg-[#002F5B] text-white' : 'text-[#002F5B] hover:bg-gray-200' }}">
        Accessories
    </a>    
    </div>    
      <!-- end categories -->

  <!-- products -->
      <div class="grid grid-cols-3 gap-4 px-5 mt-5">
        @forelse($products as $product)
        <div 
            @click="
                {{ $product->inventory && $product->inventory->quantity > 0 ? 'addToOrder({ 
                    id: ' . $product->id . ', 
                    name: \'' . $product->product . '\', 
                    price: ' . ($product->inventory ? $product->inventory->price : 0) . ', 
                    image: \'' . asset($product->image) . '\',
                    quantity: ' . ($product->inventory ? $product->inventory->quantity : 0) . ' 
                })' : '' }}"
            class="cursor-pointer hover:scale-105 px-3 duration-500 py-3 flex shadow-md flex-col border border-gray-200 rounded-md h-32 justify-between relative"
        >
            <span class="absolute p-1 top-2 right-2 font-semibold text-sm text-gray-600">
                {{ $product->inventory && $product->inventory->quantity > 0 ? 'x' . $product->inventory->quantity : 'No Stock' }}
            </span>
            <div>
                <div class="font-bold uppercase text-gray-600">{{ $product->product }}</div>
                <span class="font-light text-sm text-gray-400">{{ $product->brand }}</span>
            </div>
            <div class="flex flex-row justify-between items-center">
                <span class="self-end font-semibold text-lg text-[#002F5B]">
                    ₱{{ $product->inventory ? number_format($product->inventory->price, 2) : 'N/A' }}
                </span>
                <img src="{{ asset($product->image) }}" class="h-14 w-14 object-cover rounded-md" alt="{{ $product->product }}">
            </div>
        </div>

        @empty
          <div class="col-span-3 text-center text-gray-500">
            No products available in this category.
          </div>
        @endforelse
      </div>
    <!-- end products -->


    </div>
    <!-- end left section -->
    <!-- right section -->
    <div class="w-full lg:w-2/5">
      <!-- header -->
      <div class="flex flex-row items-center justify-between px-5 mt-5">
        <div class="font-bold pl-5 text-xl">Current Order</div>
          <div class="font-semibold flex space-x-4">
            <button @click="clearAll()" class="w-full md:w-auto flex items-center justify-end px-4 text-sm font-medium transition-all duration-500 text-white focus:outline-none bg-[#002F5B] rounded-xl borde hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-50 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Clear All</button>
            <div class="relative grid place-items-center" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="h-[40px] w-[40px] rounded-full border-2 border-gray-300 flex items-center justify-center cursor-pointer">
                    <img src="{{URL('images/person.png')}}" alt="User Icon" class="h-8 w-8 rounded-full">
                </button>
                <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden w-40 font-light z-10">
                    <p class="flex items-center justify-center px-4 py-2">{{ ucfirst(auth()->user()->firstname) }}</p>
                    <hr class="border-t border-gray-200">
                    <a href="{{ route('user.transactions') }}" class="flex items-center justify-center hover:bg-slate-100  py-2 mb-1">Transactions</a>
                    <a href="{{ route('user.warranty') }}" class="flex items-center justify-center hover:bg-slate-100  py-2 mb-1">Warranty</a>
                    <a href="{{ route('user.settings') }}" class=" flex items-center justify-center hover:bg-slate-100  py-2 mb-1">Settings</a>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class=" hover:bg-slate-100 flex items-center justify-center py-2 w-full mb-1 text-left">Logout</button>
                    </form>
                </div>
          </div>
        </div>
      </div>
      <!-- end header -->
      
       <!-- Order List -->
    <div class="px-32 py-4 mt-5 overflow-y-auto h-40">
      <template x-for="(item, index) in orderList" :key="item.id">
        <div class="flex flex-row justify-between items-center mb-4">
          <div class="flex flex-row items-center w-2/5">
            <img :src="item.image" class="w-10 h-10 object-cover rounded-md" alt="">
            <span class="ml-4 font-semibold text-sm" x-text="item.name"></span>
          </div>
          <div class="w-16 flex justify-between">
            <button @click="decreaseQuantity(index)" class="px-3 py-1 rounded-full bg-red-300 text-white">-</button>
            <span class="font-semibold mx-4" x-text="item.quantity"></span>
            <button @click="increaseQuantity(index)" class="px-3 py-1 rounded-full bg-gray-300">+</button>
          </div>
          <div class="pl-5 font-normal text-base w-16 text-center">
            ₱<span x-text="(item.quantity * item.price).toFixed(2)"></span>
          </div>
        </div>
      </template>
    </div>
    <!-- End Order List -->
    
    <!-- Total -->
    <div class="px-5">
      <div class="py-4 rounded-md shadow-lg">
        <div class="px-4 flex justify-between">
          <span class="font-medium text-sm">Number of Items</span>
          <span class="font-medium" x-text="getNumberOfItems()"></span>
        </div>
        <div class="px-4 flex justify-between">
          <span class="font-medium text-sm">Sales Total</span>
          <span class="font-medium"><span x-text="calculateTotal()"></span></span>
        </div>
        <div class="px-4 flex justify-between">
          <span class="font-medium text-sm">Sales Tax (6%)</span>
          <span class="font-medium"><span x-text="calculateTax()"></span></span>
      </div>
        <div class="px-4 pb-2 flex justify-between">
          <span class="font-medium text-sm">Change</span>
          <span class="font-medium"><span x-text="calculateChange()"></span></span>
        </div>
        <div class="px-4 flex justify-between pt-2 border-t-2">
          <span class="flex items-center justify-center font-semibold text-lg">Cash</span>
          <input type="number" x-model="cashAmount" class="font-bold px-2 py-1 border-2 rounded-md w-32" placeholder="" />
        </div>
      </div>
    </div>
    <!-- End Total -->
    
    <!-- Buttons for Typing the Cash Amount -->
    <div class="px-5 mt-5">
      <div class="rounded-md shadow-lg px-4 py-4">
        <div class="grid grid-cols-3 gap-2">
          <button @click="addCash(1)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">1</button>
          <button @click="addCash(2)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">2</button>
          <button @click="addCash(3)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">3</button>
          <button @click="addCash(4)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">4</button>
          <button @click="addCash(5)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">5</button>
          <button @click="addCash(6)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">6</button>
          <button @click="addCash(7)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">7</button>
          <button @click="addCash(8)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">8</button>
          <button @click="addCash(9)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">9</button>
          <button @click="addDecimal()" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">.</button> 
          <button @click="addCash(0)" class="bg-gray-200 p-2 transition-all duration-500 hover:bg-gray-100 rounded-md">0</button>
          <button @click="deleteLastDigit()" class="flex justify-center items-center transition-all duration-500 hover:bg-gray-100 bg-gray-200 p-2 rounded-md">
            <svg class="h-5 w-5 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
              <line x1="18" y1="9" x2="12" y2="15" />
              <line x1="12" y1="9" x2="18" y2="15" />
            </svg>
            <span class="ml-2">Delete</span>
          </button>
        </div>
      </div>
    </div>
    <!-- end buttons -->

      <!-- button pay-->
      <div class="px-5 mt-5">
        <button @click="submitOrder()" class="w-full px-4 py-4 rounded-md shadow-lg text-center bg-[#002F5B] text-white font-semibold">
          Print
      </button>  
      </div>


      <!-- end button pay -->
    </div>
    <!-- end right section -->
  </div>
</div>
</x-layoutstaff>

<script>
  function posSystem() {
      return {
          orderList: [], 
          cashAmount: '', 
          addToOrder(product) {
            if (product.quantity === 0) {
                alert('This product is out of stock!');
                return;
            }
            const existing = this.orderList.find(item => item.id === product.id);
            if (existing) {
                if (existing.quantity < product.quantity) {
                    existing.quantity += 1;
                } else {
                    alert('Cannot exceed available stock!');
                }
            } else {
                this.orderList.push({ ...product, availableQuantity: product.quantity, quantity: 1 });
            }
        },
          increaseQuantity(index) {
              const item = this.orderList[index];
              if (item.quantity < item.availableQuantity) { 
                  item.quantity += 1;
              } else {
                  alert('Cannot exceed available stock!');
              }
          },
          decreaseQuantity(index) {
              if (this.orderList[index].quantity > 1) {
                  this.orderList[index].quantity -= 1;
              } else {
                  this.orderList.splice(index, 1);  
              }
          },
          deleteItem(index) {
              this.orderList.splice(index, 1); 
          },
  
          calculateTotal() {
              return this.orderList.reduce((total, item) => total + item.quantity * item.price, 0).toFixed(2);
          },
          calculateTax() {
              const total = parseFloat(this.calculateTotal());
              const taxRate = 0.06; 
              return (total * taxRate).toFixed(2);
          },
          calculateTotalWithTax() {
              const total = parseFloat(this.calculateTotal());
              const tax = parseFloat(this.calculateTax());
              return (total + tax).toFixed(2);
          },
          getNumberOfItems() {
              return this.orderList.reduce((total, item) => total + item.quantity, 0);
          },
          calculateChange() {
               let total = parseFloat(this.calculateTotalWithTax());
              let cash = parseFloat(this.cashAmount) || 0;
              let change = cash - total;
              return change >= 0 ? change.toFixed(2) : 'Insufficient Cash';
          },
          addCash(amount) {
              this.cashAmount += amount.toString();
          },
          addDecimal() {
              if (!this.cashAmount.includes('.')) {
                  this.cashAmount += '.';
              }
          },
          deleteLastDigit() {
              this.cashAmount = this.cashAmount.slice(0, -1);
          },
          clearAll() {
              this.orderList = [];
              this.cashAmount = '';
          },
          submitOrder() {
              if (this.orderList.length === 0) {
                  alert('No products in the order list. Please add items before submitting.');
                  return;
              }

              const orderData = {
                  number_items: this.getNumberOfItems(),
                  total_amount: this.calculateTotal(),
                  cash_amount: this.cashAmount,
                  change_amount: this.calculateChange(),
                  orderList: this.orderList.map(item => ({
                      id: item.id,
                      quantity: item.quantity,
                      price: item.price
                  }))
              };

              axios.post('/salesorder', orderData)
                  .then(response => {
                      alert('Order submitted successfully!');
                      this.clearAll();

                      const orderId = response.data.orderId;

                      // Trigger PDF generation and download
                      window.open(`/salesorder/${orderId}/pdf`, '_blank');
                  })
                  .catch(error => {
                      alert('Error submitting order: ' + (error.response.data.message || error.message));
                  });
          },

      }
  }
  </script>