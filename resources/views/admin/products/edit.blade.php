<x-sidebar>
<section class="antialiased">
    <div class="mx-auto w-full">
        <div class="bg-white dark:bg-gray-80 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="flex-1 flex items-center space-x-2">
                    <h5>
                        <span class="text-gray-500">Product #:</span>
                        <span class="dark:text-white">{{ $edit->id}}</span> 
                    </h5>
                    <button type="button" class="group" data-tooltip-target="results-tooltip">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" viewbox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">More info</span>
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
               
            </div>
            <div class="py-5 mx-auto mb-3 w-9/12">
                <form action="{{ route('products.update', ['id' => $edit->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                            <input type="text" name="product" id="product" value="{{ $edit->product }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                           <option selected disabled>Select category</option>
                            <option value="Processors (CPUs)" {{ $edit->category === 'Processors (CPUs)' ? 'selected' : '' }}>Processors (CPUs)</option>
                            <option value="Motherboards" {{ $edit->category === 'Motherboards' ? 'selected' : '' }}>Motherboards</option>
                            <option value="Graphics Cards (GPUs)" {{ $edit->category === 'Graphics Cards (GPUs)' ? 'selected' : '' }}>Graphics Cards (GPUs)</option>
                            <option value="Memory (RAM)" {{ $edit->category === 'Memory (RAM)' ? 'selected' : '' }}>Memory (RAM)</option>
                            <option value="Storage Devices" {{ $edit->category === 'Storage Devices' ? 'selected' : '' }}>Storage Devices</option>
                            <option value="Accessories" {{ $edit->category === 'Accessories' ? 'selected' : '' }}>Accessories</option>

                            </select>
                        </div>
                        <div>
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                            <input type="text" name="brand" id="brand" value="{{ $edit->brand }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div>
                            <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                                <select id="supplier" name="supplier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                 <option disabled {{ !$edit->supplier_id ? 'selected' : '' }}>Select Supplier</option>
                                     @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $supplier->id == $edit->supplier_id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="original_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Original Price</label>
                            <input type="number" name="original_price" id="original_price" value="{{ $edit->original_price }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ $edit->description }}</textarea>
                        </div>
                    </div>
                    <div class="mb-4 flex items-start space-x-6">
                        <div class="flex flex-col justify-center items-center w-full max-w-md">
                            <label id="drop-area" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 008 0m2-10h2a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h2m4-3h4m-2 4v9"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, or GIF (MAX. 800x400px)</p>
                                </div>
                                <input id="image-upload" type="file" class="hidden" name="image" accept="image/*" onchange="previewImage(event)" />
                            </label>
                        </div>
                        <div class="w-1/2 flex justify-center items-center">
                            <img id="image-preview" src="{{ asset($edit->image) }}" alt="{{ $edit->product }}" class="rounded-lg shadow-lg max-h-64" />
                        </div>
                    </div>
                    <div class="flex justify-between mt-4">
                        <a href="{{ route("products.index") }}" class="">
                            <button type="button" class="inline-flex h-10 items-center justify-center text-sm w-28 font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-2 focus:ring-primary-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 dark:hover:border-gray-500 dark:focus:ring-primary-500">
                                Discard
                            </button>
                        </a>
                        <button type="submit" class="inline-flex items-center h-10 justify-center w-36 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-2 focus:ring-primary-500 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600 dark:hover:border-gray-500 dark:focus:ring-primary-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>

</x-sidebar>