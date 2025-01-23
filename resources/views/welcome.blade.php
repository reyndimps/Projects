<x-layout>  
    @guest
    <section class="pt-20 md:pt-34 bg-gradient-to-r bg-[#002f5b] text-white">
        <div class="container mx-auto px-8 lg:flex items-center">
            <!-- Text Section -->
            <div class="text-center lg:text-left lg:w-1/2 space-y-6">
                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold leading-tight">
                    Akina Computer Parts and Accessories Shop
                </h1>
                <p class="text-lg lg:text-xl font-light">
                    Find top-quality computer parts and accessories for every setup. Build, upgrade, or enhance your workspace with the latest gear. Let's power up your tech today!
                </p>
                <div class="flex flex-col sm:flex-row sm:justify-start gap-4 mt-8">
                    <a href="{{ route('login') }}">
                        <button class="py-4 px-12 bg-white text-gray-900 font-bold rounded-full shadow-md hover:bg-gray-100 hover:shadow-lg transition">
                            Get Started
                        </button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="py-4 px-12 bg-transparent border-2 border-white rounded-full transition-all duration-500 text-white hover:bg-gray-300 hover:text-gray-900 font-bold ">
                            Sign Up Now!
                        </button>
                    </a>
                </div>
            </div>

            <!-- Image Section -->
            <div class="mt-12 lg:mt-0 lg:w-1/2 flex justify-center">
                <img 
                    src="{{ asset('images/akina.jpg') }}" 
                    alt="Akina Computer Shop" 
                    class="rounded-lg shadow-lg hover:shadow-xl transition w-full max-w-md"
                >
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50 text-gray-800">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Why Choose Akina?</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <div class="w-full sm:w-1/3 bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Quality Products</h3>
                    <p class="text-sm">Only the best computer parts and accessories for every need.</p>
                </div>
                <div class="w-full sm:w-1/3 bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Expert Support</h3>
                    <p class="text-sm">Get professional advice and solutions from our team.</p>
                </div>
                <div class="w-full sm:w-1/3 bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-2">Affordable Prices</h3>
                    <p class="text-sm">Great value for money with competitive pricing.</p>
                </div>
            </div>
        </div>
    </section>
    @endguest
</x-layout>
