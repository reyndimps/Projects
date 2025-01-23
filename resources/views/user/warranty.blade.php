<x-layoutstaff>
    <section class="pt-1">
        <div class="bg-white p-6 rounded-lg shadow-md">
                   <!-- Top Bar -->
                   <div class="flex justify-between items-center">
                    <h1 class="text-2xl text-[#002F5B] font-bold">Warranty Checker (Sold Products)</h1>
    
                    <!-- User Dropdown -->
                    <div class="pt-5 pr-5 relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="h-[40px] w-[40px] rounded-full border-2 border-gray-300 flex items-center justify-center cursor-pointer">
                            <img src="{{ URL('images/person.png') }}" alt="User Icon" class="h-8 w-8 rounded-full">
                        </button>   
                        <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute top-12 right-0 rounded-lg overflow-hidden w-40 font-light z-10">
                            <p class="flex items-center justify-center px-4 py-2">{{ ucfirst(auth()->user()->firstname) }}</p>
                            <hr class="border-t border-gray-200">
                            <a href="{{ route('user.dashboard') }}" class="flex items-center justify-center hover:bg-slate-100 py-2 mb-1">POS System</a>
                            <a href="{{ route('user.transactions') }}" class="flex items-center justify-center hover:bg-slate-100 py-2 mb-1">Transactions</a>
                            <a href="{{ route('user.settings') }}" class="flex items-center justify-center hover:bg-slate-100 py-2 mb-1">Settings</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="hover:bg-slate-100 flex items-center justify-center py-2 w-full mb-1 text-left">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
    
                <!-- Search Bar -->
                <form action="" class="pb-5 flex items-center">
                    <label for="{{ route('user.warranty') }}" method="GET" class="sr-only">Search</label>
                    <div class="relative">
                        <input
                            name="search"
                            class="w-96 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border-2 border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                            placeholder="Search For Products"
                            value="{{ request('search') }}"/>
                        <button class="absolute top-1 right-1 flex items-center rounded bg-[#002F5B] py-1 px-2.5 border duration-500 border-transparent text-center text-sm text-white transition-all shadow-sm active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                            </svg>
                            Search
                        </button>
                    </div>
                </form>

            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-sm leading-normal">
                        <th class="py-3 px-6 text-center">#</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Product Name</th>
                        <th class="py-3 px-6 text-center">Product Code</th>
                        <th class="py-3 px-6 text-center">Purchased Date</th>
                        <th class="py-3 px-6 text-center">Warranty Ends</th>
                        <th class="py-3 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse ($salesItems as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-center">{{  $loop->iteration  }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->quantity }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->inventory->product->product }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->inventory->product->product_code }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->created_at->format('F j, Y') }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->warranty_end_date->format('F j, Y')  }}</td>
                            <td class="py-3 px-6 text-center">
                                @if ($item->warranty_end_date->isFuture())
                                    <span class="px-3 py-1 text-green-700 bg-green-100 rounded-full">
                                        Under Warranty
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-red-700 bg-red-100 rounded-full">
                                        Expired
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6">
                                No sold products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $salesItems->links() }}
            </div>
        </div>
    </section>
</x-layoutstaff>
