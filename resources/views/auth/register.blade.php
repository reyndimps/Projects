<x-layout>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex justify-center min-h-screen">
        <!-- Image Section -->
        <div 
            class="hidden lg:flex lg:w-2/5 items-center justify-center bg-gradient-to-br bg-[#002F5B]">
            <div class="flex flex-col items-center justify-center p-8">
                <img 
                    src="{{ asset('images/akinalogo.jpg') }}" 
                    alt="Akina Computer Logo" 
                    class="w-3/4 max-w-md bg-center rounded-xl hover:scale-105 transition-transform duration-300"
                >
    
            </div>
        </div>

      <div class="flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
          <div class="w-full">
              <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                  Sign Up 
              </h1>

              <p class="mt-4 text-gray-500 dark:text-gray-400">
                  Let’s get you all set up so you can verify your personal account.
              </p>


              <form class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-2" action="{{ route('register') }}" method="post">
                @csrf
                  <div>
                      <label for="firstname" lass="block mb-2 text-sm text-gray-600 dark:text-gray-200">First Name</label>
                      <input type="text" name="firstname" id="firstname" value="{{old('firstname')}}" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 @error('firstname') ring-red-500 @enderror"/>
                      @error('firstname')
                      <p class="text-red-600 text-sm">{{ $message }}</p>
                       @enderror
                    </div>

                  <div>
                      <label for="lastname" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Last name</label>
                      <input type="text" name="lastname" id="lastname" value="{{old('lastname')}}" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      @error('lastname')
                      <p class="text-red-600 text-sm">{{ $message }}</p>
                      @enderror
                    </div>

                  <div>
                      <label for="phone_number" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Phone number</label>
                      <input type="text" placeholder="63+" value="{{old('phone_number')}}" name="phone_number" id="phone_number" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      @error('phone_number')
                      <p class="text-red-600 text-sm">{{ $message }}</p>
                      @enderror
                    </div>

                  <div>
                      <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email address</label>
                      <input type="text" name="email" id="email" value="{{old('email')}}" autocomplete="email" placeholder="example@gmail.com" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      @error('email')
                      <p class="text-red-600 text-sm">{{ $message }}</p>
                      @enderror
                    </div>

                  <div>
                      <label for="password" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Password</label>
                      <input type="password" name="password" id="password" autocomplete="new-password" placeholder="Enter your password" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      @error('password')
                      <p class="text-red-600 text-sm">{{ $message }}</p>
                      @enderror
                    </div>

                  <div>
                      <label for="password_confirmation" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Confirm password</label>
                      <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" placeholder="Enter your password" class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                      @error('password')
                      <p class="text-red-600 text-sm">{{ $message }}</p>
                      @enderror
                    </div>

                  <button type ="submit"
                      class="flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-500 transform bg-[#002F5B] rounded-md focus:outline-none focus:ring">
                      <span>Sign Up </span>

                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd" />
                      </svg>
                  </button>
              </form>
              <p class="mt-6 text-sm text-center text-gray-400">Already Have an Account? <a href="{{ route('login') }}" class="text-[#002F5B]  focus:outline-none focus:underline hover:underline">Login</a>.</p>
  
          </div>
      </div>
  </div>
</section>

</x-layout>
