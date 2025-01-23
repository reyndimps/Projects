<x-sidebar>
<section class="antialiased">
    <div class="mx-auto w-full">
        <div class="bg-white dark:bg-gray-80 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500">All Products:</span>
                        <span class="dark:text-white">{{ $products->count()}}</span> 
                    </h5>
                    <!-- <h5 class="text-gray-500 dark:text-gray-400 ml-1"></h5> -->
                    <button type="button" class="group" data-tooltip-target="results-tooltip">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" viewbox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">More info</span>
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                <div class="w-full md:w-1/2">
                    <form action="" class="flex items-center">
                        <label for="{{route('products.index')}}" method="GET" class="sr-only">Search</label>
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
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button type="button" id="createProductButton" data-modal-toggle="createProductModal" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add product
                    </button>
     
                </div>
            </div>
            @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400 flex items-center justify-center" role="alert">
                <span class="font-medium mr-1">Success! </span> Successfully added the product.
            </div>
            @elseif(session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400 flex items-center justify-center" role="alert">
                <span class="font-medium mr-1">Success! </span> Successfully added the product.
            </div>
            @elseif(session('update'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400 flex items-center justify-center" role="alert">
                <span class="font-medium mr-1">Success! </span> Successfully Updated the product.
            </div>
            @elseif(session('delete'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400 flex items-center justify-center" role="alert">
                <span class="font-medium mr-1">Success! </span> The product was deleted.
            </div>
            @elseif($errors->has('category'))
            <div class="p-4 mb-4 text-sm text-red-500 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400 flex items-center justify-center" role="alert">
                <span class="font-medium mr-1">Error! </span> {{ $errors->first('category') }}
            </div>
            @endif
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                            <div class="flex items-center">
                                    #
                                </div>
                            </th>
                            <th scope="col" class="p-4">Product</th>
                            <th scope="col" class="p-4">Image</th>
                            <th scope="col" class="p-4">Original Price</th>
                            <th scope="col" class="p-4">Supplier</th>
                            <th scope="col" class="p-4">Category</th>
                            <th scope="col" class="p-4">Brand</th>
                            <th scope="col" class="p-4">Description</th>
                            <th scope="col" class="p-4">Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                             $startId = ($products->currentPage() - 1) * $products->perPage() + 1;
                        @endphp

                        @forelse ($products as $product)
                        <tr class=" border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 w-4">
                                <div class="flex items-center">
                                    <!-- # -->
                                    {{ $startId++ }}
                                </div>
                            </td>
                            <th scope="row" class="px-4 py-3 font-light text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center uppercase">
                                    <!-- Product-->
                                    {{ $product->product }}
                                </div>
                            </th>
                            <th scope="row" class="px-4 py-3 font-light text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center">
                                    <!-- image-->
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->product }}" class="h-10 w-10 object-cover">
                                </div>
                            </th>
                            <th scope="row" class="px-4 py-3 font-light text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center uppercase">
                                    <!-- Original_price-->
                                    ₱{{ number_format($product->original_price, 2) }}
                                </div>
                            </th>
                            <td class="px-4 py-3 font-light text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center uppercase">
                                    <!--Supplier-->
                                    {{ $product->supplier?->name ?? 'No Supplier' }}
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-primary-800 text-xs font-medium px-2 py-1 rounded dark:bg-primary-900 dark:text-primary-300">
                                    <!-- Category-->
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-light text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center uppercase">
                                    <!--Brand-->
                                    {{ $product->brand }}
                                </div>
                            </td>
                            <td class="px-4 py-3 font-light text-gray-900 whitespace-normal dark:text-white">
                                <div class="flex flex-col uppercase">
                                    <span>{{ $product->description }}</span>
                                </div>
                            </td>
                            
                            <!--Last Update-->
                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('products.edit', ['id' => $product->id]) }}">
                                        <button type="button" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                            Edit
                                        </button>
                                    </a>
                                        <button type="button" data-drawer-target="drawer-read-product-advanced-{{ $product->id }}" data-drawer-show="drawer-read-product-advanced" aria-controls="drawer-read-product-advanced" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                            </svg>
                                            Preview
                                        </button>
                                        <button type="button" id="deleteButton" 
                                        data-modal-target="deleteModal" 
                                        data-modal-toggle="deleteModal" 
                                        data-product-id="{{ $product->id }}"
                                        class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Delete
                                    </button>
                                    
                                </div>
                            </td>
                            </tr>   
                        @empty
                        <tr>
                            <td colspan="10" class="px-4 py-5 text-center font-medium text-gray-900 dark:text-white">
                                No products found.
                            </td>
                        </tr>
                        @endforelse 
                    </tbody>
                </table>    
            </div>
            <nav class="flex flex-col md:flex-row justify-end items-start md:items-center space-y-3 md:space-y-0 p-1" aria-label="Table navigation">
                {{ $products->appends(['search' => request('search')])->links() }}
            </nav>
            
        </div>
    </div>
</section>

<!-- ADD PRODUCT-->
<div id="modal-overlay" class="fixed inset-0 z-50 overflow-y-auto overflow-x-hidden flex items-center justify-center bg-opacity-50"></div>
<div id="createProductModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black opacity-50"></div> 
        <div class="relative p-4 w-full max-w-3xl bg-white rounded-lg shadow-lg">
            <div class="relative p-4 bg-white rounded-lg shadow sm:p-5"> 
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Product</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                            <input type="text" name="product" id="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="" selected disabled>Select category</option>
                                <option value="Processors (CPUs)">Processors (CPUs)</option>
                                <option value="Motherboards">Motherboards</option>
                                <option value="Graphics Cards (GPUs)">Graphics Cards (GPUs)</option>
                                <option value="Memory (RAM)">Memory (RAM)</option>
                                <option value="Storage Devices">Storage Devices</option>
                                <option value="Accessories ">Accessories </option>
                            </select>
                        </div>
                        <div>
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                            <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                        </div>
                        <div>
                            <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Suppliers</label>
                            <select id="supplier" name="supplier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="" selected disabled>Suppliers</option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>  
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="original_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Original Price</label>
                            <input type="number" name="original_price" id="original_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Price" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Images</span>
                        <div class="flex justify-start items-center w-full">
                            <label id="drop-area" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Drag and drop an image here</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="image" type="file" name="image" class="hidden" accept="image/*" onchange="readURL(this);" />
                            </label>
                            <img id="modal-preview" class="hidden w-64 h-54 p-2 object-cover mt-3 ml-4" src="#" alt="Image Preview">
                        </div>
                    </div>                    
                    <div class="flex justify-between mt-4">
                        <button type="button" id="discardButtonn" class="inline-flex items-center justify-center text-sm w-28 font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-2 focus:ring-primary-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 dark:hover:border-gray-500 dark:focus:ring-primary-500" data-modal-toggle="createProductModal">
                            Discard
                        </button>
                        <button type="submit" class="inline-flex items-center h-10 justify-center w-28 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-2 focus:ring-primary-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 dark:hover:border-gray-500 dark:focus:ring-primary-500" data-modal-toggle="createProductModal">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 
@foreach ($products as $product)
<!-- PREVIEW MODAL -->
<div id="drawer-read-product-advanced-{{ $product->id }}" class="overflow-y-auto fixed top-0 left-0 z-40 p-4 w-full max-w-2xl h-screen bg-white border-solid border-2 border-gray-100  transition-transform -translate-x-full dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <div>
        <h4 id="read-drawer-label" class="mb-1.5 leading-none text-xl font-semibold text-gray-900 dark:text-white">{{ ucfirst($product->product) }}</h4>
    </div>
    <button type="button" data-drawer-dismiss="drawer-read-product-advanced-{{ $product->id }}" aria-controls="drawer-read-product-advanced" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <div class="grid place-items-center sm:mb-5">
        <div class="p-2 w-full max-w-xs flex justify-center">
            <img src="{{ asset($product->image) }}" alt="{{ $product->product }}" class="h-full w-[300px] object-cover">
        </div>
    </div>
    
    <dl class="sm:mb-5"><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
        <dd class=" font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ucfirst($product->description)}}<dl class="pt-8 grid grid-cols-2 gap-4 mb-4">
        <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Supplier</dt>
            <dd class="text-gray-500 dark:text-gray-400">
                {{ucfirst($product->supplier?->name ?? 'No Supplier')}}
            </dd>
        </div>
        <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600"><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Brand</dt><dd class="text-gray-500 dark:text-gray-400">{{ucfirst($product->brand)}}</dd></div>
        <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600"><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt><dd class="text-gray-500 dark:text-gray-400">{{ucfirst($product->category)}}</dd></div>
        <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600"><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Original Price</dt><dd class="text-gray-500 dark:text-gray-400">{{ number_format($product->original_price, 2) }}</dd></div>
        <div class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600"><dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Last Update</dt><dd class="text-gray-500 dark:text-gray-400">{{ $product->updated_at->diffForHumans()}}</dd></div>
    </dl>

</div>
@endforeach

<!-- DELETE MODAL -->
<div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 overflow-y-auto overflow-x-hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" id="closeModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
            <div class="flex justify-center items-center space-x-4">
                <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600" id="cancelButton">
                    No, cancel
                </button>
                <form action="" method="POST"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        Yes, I'm sure
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal-->
<script>
    const editModal = document.getElementById('editProductModal');
    const openEditModalButton = document.getElementById('editProductButton'); 
    const closeEditModalButton = editModal.querySelector('[data-modal-toggle="editProductModal"]');
    const editModalOverlay = document.getElementById('modal-overlay'); 
    const discardButton = document.getElementById('discardButton');
    
    openEditModalButton.addEventListener('click', (event) => {
        event.preventDefault(); 
        const productId = event.target.getAttribute('data-product-id'); 
        loadProductData(productId); 
    });

    function loadProductData(productId) {
        fetch(`/products/${productId}/edit`)
            .then(response => response.json())
            .then(product => {
                document.getElementById('product').value = product.product;
                document.getElementById('category').value = product.category;
                document.getElementById('stock').value = product.stock;
                document.getElementById('price').value = product.price;
                document.getElementById('supplier').value = product.supplier;
                document.getElementById('brand').value = product.brand;
                document.getElementById('description').value = product.description || '';
    
                const imagePreview = document.getElementById('image-preview');
                const imagePreviewContainer = document.getElementById('image-preview-container');
                if (product.image) {
                    imagePreview.src = '/' + product.image; 
                    imagePreview.style.display = 'block'; 
                    imagePreviewContainer.classList.remove('hidden'); 
                } else {
                    imagePreview.style.display = 'none'; 
                    imagePreviewContainer.classList.add('hidden'); 
                }
            })
            .catch(error => console.error('Error loading product data:', error));
    
        editModal.classList.remove('hidden');
        editModalOverlay.classList.remove('hidden'); 
    }
    
    closeEditModalButton.addEventListener('click', () => {
        editModal.classList.add('hidden');
        editModalOverlay.classList.add('hidden');
    });

        discardButton.addEventListener('click', () => {
            editModal.classList.add('hidden');
            editModalOverlay.classList.add('hidden');
        });

    
    window.addEventListener('click', (event) => {
        const modalContent = editModal.querySelector('.relative'); 
        if (event.target === editModalOverlay || (!modalContent.contains(event.target) && !openEditModalButton.contains(event.target))) {
            editModal.classList.add('hidden');
            editModalOverlay.classList.add('hidden');
        }
    });
    
    document.getElementById('image-upload').addEventListener('change', function (event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imagePreview = document.getElementById('image-preview'); 
                imagePreview.src = e.target.result; 
                imagePreview.style.display = 'block'; 
                document.getElementById('image-preview-container').classList.remove('hidden'); 
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>

<!-- ADD MODAL -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const createModal = document.getElementById('createProductModal');
        const openCreateModalButton = document.getElementById('createProductButton'); // Ensure this button exists
        const closeCreateModalButton = createModal.querySelector('[data-modal-toggle="createProductModal"]');
        const modalOverlay = document.getElementById('modal-overlay');
        const discardButtonn = document.getElementById('discardButtonn');
        const previewImage = document.getElementById('modal-preview');

        // Function to close the modal
        function closeModal() {
            createModal.classList.add('hidden');
            modalOverlay.classList.add('hidden'); 
            previewImage.classList.add('hidden'); // Hide the image preview when closing the modal
            // Clear the file input
            document.getElementById('image').value = ''; // Reset the image input
        }

        // Open modal when the button is clicked
        openCreateModalButton.addEventListener('click', () => {
            createModal.classList.remove('hidden');
            modalOverlay.classList.remove('hidden'); 
        });

        // Close modal when the close button or discard button is clicked
        closeCreateModalButton.addEventListener('click', closeModal);
        discardButtonn.addEventListener('click', closeModal);

        // Close modal when clicking outside of it
        window.addEventListener('click', (event) => {
            const modalContent = createModal.querySelector('.relative'); 
            if (event.target === modalOverlay || (!modalContent.contains(event.target) && !openCreateModalButton.contains(event.target))) {
                closeModal();
            }
        });

        // Function to read the URL of the selected image
        window.readURL = function(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden'); // Show the image
                };
                reader.readAsDataURL(input.files[0]); // Convert to base64 string
            }
        }
    });
</script>
   

<!--PREVIEW MODAL -->
<script>
function openDrawer(drawerId) {
    const drawer = document.getElementById(drawerId);
    if (drawer) {
        drawer.classList.remove('-translate-x-full');
        drawer.setAttribute('aria-hidden', 'false');
        document.addEventListener('click', outsideClickListener);
    }
}

function closeDrawer(drawerId) {
    const drawer = document.getElementById(drawerId);
    if (drawer) {
        drawer.classList.add('-translate-x-full');
        drawer.setAttribute('aria-hidden', 'true');
        document.removeEventListener('click', outsideClickListener);
    }
}

function outsideClickListener(event) {
    const openDrawer = document.querySelector('.overflow-y-auto[aria-hidden="false"]');
    if (openDrawer && !openDrawer.contains(event.target)) {
        closeDrawer(openDrawer.id);
    }
}

document.querySelectorAll('[data-drawer-target]').forEach(button => {
    button.addEventListener('click', (event) => {
        const targetId = button.getAttribute('data-drawer-target');
        openDrawer(targetId);
        event.stopPropagation();
    });
});

document.querySelectorAll('[data-drawer-dismiss]').forEach(button => {
    button.addEventListener('click', function(event) {
        const targetId = this.getAttribute('data-drawer-dismiss');
        closeDrawer(targetId);

        event.stopPropagation();
    });
});
    
</script>

<!-- DELETE MDOAL-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    
        document.querySelectorAll('#deleteButton').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const modal = document.getElementById('deleteModal');
            
                const form = modal.querySelector('form');
                form.action = `{{ url('products') }}/${productId}`; 
    
                modal.classList.remove('hidden');
                modal.classList.add('flex', 'opacity-100');
            });
        });
    
        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex', 'opacity-100');
        });

        document.getElementById('cancelButton').addEventListener('click', function() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex', 'opacity-100');
        });
    
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex', 'opacity-100');
            }
        });
    });
</script>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</x-sidebar>