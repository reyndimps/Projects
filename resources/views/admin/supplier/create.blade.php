<x-sidebar>
  <section class="bg-cream-lighter p-6 shadow">
  <div class="md:flex">
    <h2 class="md:w-1/3 uppercase tracking-wide text-sm sm:text-lg mb-6">Suppliers Information</h2>
  </div>
  <form action="{{route('suppliers.store')}}" method="POST">
    @csrf
    <div class="md:flex mb-8">
      <div class="md:w-1/3">
        <legend class="uppercase tracking-wide text-sm">Profile</legend>
        <p class="text-xs font-light text-red">This entire section is required.</p>
      </div>
    <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
      <div class="mb-4">
        <label class="block uppercase tracking-wide text-xs font-bold">Full Name</label>
        <input class="w-full shadow-inner p-4 border-0" value="{{old('name')}}"  type="text" id="name" name="name" placeholder="Fiel Eminedo" required="">
        @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>
      <div class="md:flex mb-4">
        <div class="md:flex-1 md:pr-3">
          <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Company</label>
          <input class="w-full shadow-inner p-4 border-0" value="{{old('company')}}" type="text" name="company" placeholder="" required="">
          @error('company')
          <p class="text-red-600 text-sm">{{ $message }}</p>
          @enderror
        </div>
        <div class="md:flex-1 md:pl-3">
          <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Country</label>
          <select class="rounded-md w-full py-1.5 p-1 border-2 text-charcoal-darker text-sm" id="country" name="country" required="">
            <option disabled {{ old('country') ? '' : 'selected' }}>Select Country</option>
            <option value="Philipines" {{ old('country') == 'Philipines' ? 'selected' : '' }}>Philipines</option>
            <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
            <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
            <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
            <option value="Korea" {{ old('country') == 'Korea' ? 'selected' : '' }}>Korea</option>
            <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>    
          </select>
          @error('country')
          <p class="text-red-600 text-sm">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <div class="md:flex mb-4">
        <div class="md:flex-1 md:pr-3">
          <label class="block uppercase tracking-wide text-charcoal-darker text-xs pb-2 font-bold">Active</label>
          <div class="relative inline-block w-11 h-5">
              <input 
                  type="checkbox" 
                  id="switch-component" 
                  name="status" 
                  value="active" 
                  class="peer appearance-none w-11 h-5 bg-red-500 rounded-full checked:bg-green-500 cursor-pointer transition-colors duration-300"
                  checked
              />
              <label 
                  for="switch-component" 
                  class="absolute top-0 left-0 w-5 h-5 bg-white rounded-full border border-slate-300 shadow-sm transition-transform duration-300 peer-checked:translate-x-6 peer-checked:border-slate-800 cursor-pointer">
              </label>        
          </div>
      </div>      
          <div class="md:flex-1 md:pl-3">
            <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Industry type</label>
            <select class="rounded-md w-full py-1.5 p-1 border-2 text-charcoal-darker text-sm" id="industry_type" name="industry_type" required="">
              <option disabled {{ old('industry_type') ? '' : 'selected' }}>Select Industry Type</option>
              <option value="Electronics Manufacturing" {{ old('industry_type') == 'Electronics Manufacturing' ? 'selected' : '' }}>Electronics Manufacturing</option>
              <option value="IT Hardware Distribution" {{ old('industry_type') == 'IT Hardware Distribution' ? 'selected' : '' }}>IT Hardware Distribution</option>
              <option value="Consumer Electronics" {{ old('industry_type') == 'Consumer Electronics' ? 'selected' : '' }}>Consumer Electronics</option>
              <option value="Gaming and High-Performance Computing" {{ old('industry_type') == 'Gaming and High-Performance Computing' ? 'selected' : '' }}>Gaming and High-Performance Computing</option>
              <option value="Networking and Telecommunications" {{ old('industry_type') == 'Networking and Telecommunications' ? 'selected' : '' }}>Networking and Telecommunications</option>
              <option value="Repair and Maintenance Services" {{ old('industry_type') == 'Repair and Maintenance Services' ? 'selected' : '' }}>Repair and Maintenance Services</option>
              <option value="Recycling and Refurbishment" {{ old('industry_type') == 'Recycling and Refurbishment' ? 'selected' : '' }}>Recycling and Refurbishment</option>      
            </select>
            @error('industry_type')
            <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="md:flex mb-8">
      <div class="md:w-7/12">
        <legend class="uppercase tracking-wide text-sm">Contact</legend>
      </div>
      <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
        <div class="mb-4">
          <label class="block uppercase tracking-wide text-xs font-bold">Phone</label>
          <input class="w-full shadow-inner p-4 border-0" value="{{old('phone')}}"  type="tel" name="phone" placeholder="63+" required="">
          @error('phone')
          <p class="text-red-600 text-sm">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Email</label>
          <input class="w-full shadow-inner p-4 border-0"value="{{old('email')}}"  type="text" name="email" placeholder="example@gamil.com" required="">
          @error('email')
          <p class="text-red-600 text-sm">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Adress</label>
          <input class="w-full shadow-inner p-4 border-0"value="{{old('address')}}"  type="text" name="address" placeholder="" required="">
          @error('address')
          <p class="text-red-600 text-sm">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>
      <div class=" flex justify-end items-end">
      <button type="submit" class="w-full md:w-auto flex items-center justify-end py-3 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
        <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
        </svg>
        Add Supplier
    </button>
      </div>
    </form>
  </section>
</x-sidebar>