<x-layoutstaff>
   
<section class="antialiased">
    <div class="">
        <div class="p-10 h-full bg-white relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form action="" class="flex items-center">
                        <label for="{{route('user.transactions')}}" method="GET" class="sr-only">Search</label>
                          <div class="relative">
                            <input
                              name="search"
                              class="w-full bg-transparent border-2 placeholder:text-slate-400 text-slate-700 text-sm border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                              placeholder="Search For Products" 
                              value=""
                            />
                            <button class="absolute top-1 right-1 flex items-center rounded bg-[#002F5B] py-1 px-2.5 border duration-500 border-transparent text-center text-sm text-white transition-all shadow-sm  active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"type="submit">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2">
                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                              </svg>
                              Search
                            </button> 
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <div class="relative grid place-items-center" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="h-[40px] w-[40px] rounded-full border-2 border-gray-300 flex items-center justify-center cursor-pointer">
                                <img src="{{URL('images/person.png')}}" alt="User Icon" class="h-8 w-8 rounded-full">
                            </button>
                            <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden w-40 font-light z-10">
                                <p class="flex items-center justify-center px-4 py-2">{{ ucfirst(auth()->user()->firstname) }}</p>
                                <hr class="border-t border-gray-200">
                                <a href="{{ route('user.dashboard') }}" class="flex items-center justify-center hover:bg-slate-100  py-2 mb-1">POS System</a>
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
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-4">#</th>
                            <th scope="col" class="px-4 py-4">Number of Items</th>
                            <th scope="col" class="px-4 py-3">Total Amount</th>
                            <th scope="col" class="px-4 py-3">Cash Amount</th>
                            <th scope="col" class="px-4 py-3">Sales taxe</th>
                            <th scope="col" class="px-4 py-3">Change Amount</th>
                            <th scope="col" class="px-4 py-3">Time Purchased</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse( $salesorder as $salesord )
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{  $loop->iteration  }}</th>
                            <td class="px-4 py-3">{{ $salesord->number_items }}</td>
                            <td class="px-4 py-3">₱{{ number_format($salesord->total_amount, 2) }}</td>
                            <td class="px-4 py-3">₱{{ number_format($salesord->cash_amount, 2) }}</td>
                            <td class="px-4 py-3">₱{{ number_format($salesord->sales_tax, 2) }}</td>
                            <td class="px-4 py-3">₱{{ number_format($salesord->change_amount, 2) }}</td>
                            <td class="px-4 py-3">{{ $salesord->created_at->diffForHumans()}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-6">
                                No Transaction Made Yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="h-screen">
                {{ $salesorder->links() }}
            </div>
        </div>
    </div>
</section>
</x-layoutstaff>