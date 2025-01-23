<x-sidebar>
    <ul class="pl-20 mx-auto flex flex-wrap text-sm font-medium text-center text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400">
        <li class="me-2">
            <a href="{{ route('admin.inventory') }}" aria-current="page" class="inline-block p-4 text-slate-800 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-slate-500">Current Stocks</a>
        </li>
        <li class="me-2">
            <a href="{{ route('stocksTransaction') }}" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">Stock Transactions</a>
        </li>
        <div class="flex ml-auto items-center pr-20">
            <form action="" class="flex items-center">
                <label for="{{ route('admin.inventory') }}" method="GET" class="sr-only">Search</label>
                <div class="relative w-80">
                    <input
                        name="search"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Search For Products" 
                        value="{{ request('search') }}"
                    />
                    <button class="absolute top-1 right-1 flex items-center rounded bg-[#002F5B] py-1 px-2.5 border duration-500 border-transparent text-center text-sm text-white transition-all shadow-sm active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
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

                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Product
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Supplier
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Product Code
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Current Qty
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Qty
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Retail Price
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Date Added
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Expiration Date
                        </span>
                    </th>
                    <th class="px-6 py-3">
                        <span class="flex items-center">
                            Action
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <form action="{{ route('updateStock', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="pl-8">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->product }}" class="w-8 h-8 object-cover">
                            </td>
                            <td class="px-3 py-4 text-sm font-semibold leading-6 text-gray-600 dark:text-white">
                                {{ $product->product }}
                            </td>
                            <td class="px-3 py-4 text-sm font-medium leading-6 text-gray-600 dark:text-white">
                                {{ $product->supplier?->name ?? 'No Supplier' }}
                            </td>
                            <td class="px-3 py-4 text-sm font-medium leading-6 text-gray-600 dark:text-white">
                                {{ $product->product_code ?? 'No Product Code' }}
                            </td>
                            <td class="px-3 py-4">
                                {{ $product->inventory?->quantity ?? 0 }}
                                @if($product->inventory?->quantity <= 50)
                                    <div class="mt-1 text-xs text-red-600 font-semibold">
                                        ⚠️ Critical: Low stock!
                                    </div>
                                @elseif($product->inventory?->quantity <= 60)
                                    <div class="mt-1 text-xs text-yellow-500 font-semibold">
                                        ⚠️ Warning: Stock is getting low.
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-4">
                                <input type="number" name="quantity" class="w-14 px-2 py-1 border-2 rounded-lg focus:ring-gray-300" required />
                            </td>
                            <td class="px-3 py-4 text-sm font-medium leading-6 text-gray-600 dark:text-white">
                                <input
                                    type="text"
                                    name="price"
                                    placeholder="₱"
                                    class="border-2 border-gray-300 focus:border-gray-300 focus:ring-gray-300 rounded px-3 py-2"
                                    value="{{ old('price', $product->inventory?->price ?? '') }}"
                                    required
                                />
                            </td>
                            <td class="px-3 py-4">
                                <input
                                    type="text"
                                    name="date_added"
                                    id="datepicker-{{ $product->id }}"
                                    class="border-2 border-gray-300 focus:border-gray-300 focus:ring-gray-300 rounded px-3 py-2"
                                    placeholder="Select a date"
                                    required
                                />
                            </td>
                            <td class="px-3 py-4">
                                <input
                                    type="text"
                                    name="expiration_date"
                                    id="datepicker-exp-{{ $product->id }}"
                                    class="border-2 border-gray-300 focus:border-gray-300 focus:ring-gray-300 rounded px-3 py-2"
                                    placeholder="Select a date"
                                    required
                                />
                            </td>
                            <td class="px-6 py-4">
                                <button type="submit" class="font-medium p-3 text-gray-900 dark:text-red-500 hover:underline">
                                    Save
                                </button>
                            </td>
                        </tr>
                    </form>
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-5 text-center font-medium text-gray-900 dark:text-white">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4 ">
            {{ $products->appends(['search' => request('search')])->links('pagination::tailwind') }}
        </div>
    </div>

</x-sidebar>
