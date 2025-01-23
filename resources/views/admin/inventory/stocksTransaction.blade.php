<x-sidebar>
    <ul class="pl-20 mx-auto flex flex-wrap text-sm font-medium text-center text-gray-500  border-gray-200 dark:border-gray-700 dark:text-gray-400">
        <li class="me-2">
            <a href="{{ route('admin.inventory') }}"  class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Current Stocks</a>
        </li>
        <li class="me-2">
            <a href="{{ route('stocksTransaction') }}" aria-current="page" class="inline-block p-4 text-slate-800 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-slate-500">Stock Transactions</a>
        </li>
        <div class="flex ml-auto items-center pr-20">
            <form action="" class="flex items-center">
                <label for="{{route('stocksTransaction')}}" method="GET" class="sr-only">Search</label>
                  <div class="relative w-80">
                    <input
                      name="search"
                      class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                      placeholder="Search For Products" 
                      value="{{ request('search') }}"
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
    </ul>
    @if(session('success'))
    <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 flex items-center justify-center" role="alert">
        <div class="text-green-500">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <div class="overflow-x-auto border rounded-lg border-gray-300">
        <table id="default-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            #
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Product
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Supplier
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Product Code
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-4 py-3">
                        <span class="flex items-center">
                            Quantity
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-4 py-3">
                        <span class="flex items-center">
                            Price
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-4 py-3">
                        <span class="flex items-center">
                            Date Added
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-4 py-3">
                        <span class="flex items-center">
                            Expiration Date
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                            </svg>
                        </span>
                    </th>
                    <th class="px-4 py-3">
                        <span class="flex items-center">
                            Action
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                    @csrf
                    @method('DELETE')
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-4 py-4">{{  $loop->iteration  }}</td>
                    <td class="flex px-4 py-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img src="{{ asset($transaction->product->image) }}" alt="{{ $transaction->product->image }}" class="w-5 h-5 object-cover">
                        <div class ="p-1">
                            {{ $transaction->product->product  }}
                        </div>
                    </td>
                    <td class="px-4 py-4">{{ $transaction->product->supplier->name ?? 'N/A' }}</td>
                    <td class="px-4 py-4">  {{ $transaction->product->product_code ?? 'N/A' }}</td>
                    <td class="px-4 py-4">{{ $transaction->quantity_changed }}</td>
                    <td class="px-4 py-4">{{ number_format($transaction->price_updated, 2) }}</td>
                    <td class="px-4 py-4">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('F j, Y')  }}</td>
                    <td class="px-4 py-4">{{ \Carbon\Carbon::parse($transaction->expiration_date)->format('F j, Y')  }}</td>
                    <td class="px-4 py-4"><button type="submit" class="font-medium text-red-500 dark:text-red-500 hover:underline">
                        Delete
                    </button>
                </td>
            </form>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-5 text-center font-medium text-gray-900 dark:text-white">
                        No stock transactions found.
                    </td>
                </tr>
                @endforelse                
            </tbody>
        </table>
            {{ $transactions->links() }}
    </div>
</x-sidebar>
