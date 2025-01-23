<x-layout>
<div class="bg-white dark:bg-gray-900">
    <div class="flex justify-center w-full h-full">
        <div 
            class="hidden lg:flex lg:w-2/3 items-center justify-center h-screen bg-gradient-to-br bg-[#002F5B]">
            <div class="flex flex-col items-center justify-center p-4">
                <img 
                    src="{{ asset('images/akinalogo.jpg') }}" 
                    alt="Akina Computer Logo" 
                    class="w-4/5 max-2xl bg-center rounded-xl hover:scale-105 transition-transform duration-300"
                >
    
            </div>
        </div>
        
        
        <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
            <div class="flex-1">
                <div class="text-center">
                    <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">Login</h2>
                    
                    <p class="mt-3 text-gray-500 dark:text-gray-300">Sign in to access your account</p>
                </div>

                <div class="mt-8">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Email Address</label>
                            <input type="email"  name="email" id="email" placeholder="example@gmail.com" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            @error('email')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                             @enderror
                        </div>

                        <div class="mt-6">
                            <div class="flex justify-between mb-2">
                                <label for="password" class="text-sm text-gray-600 dark:text-gray-200">Password</label>
                    
                            </div>

                            <input type="password" name="password" id="password" placeholder="Your Password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            @error('password')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                             @enderror
                        </div>
                        <hr>
                        @error('failed')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
          
                        <div class="mt-6">
                            <button
                            type="submit"
                                class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-500 transform bg-[#002F5B] rounded-md focus:outline-none">
                                Sign in
                            </button>
                        </div>

                    </form>

                    <p class="mt-6 text-sm text-center text-gray-400">Don&#x27;t have an account yet? <a href="{{ route('register') }}" class="text-[#002F5B] focus:outline-none focus:underline hover:underline">Sign up</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout>
