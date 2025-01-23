<x-layoutstaff>
  <section class="bg-cream-lighter px-32 py-10 shadow">
      <div class="md:flex justify-between items-center mb-6">
        <h2 class="md:w-1/3 uppercase tracking-wide text-sm sm:text-lg">User Information</h2>
        <div class="relative pr-3" x-data="{ open: false }">
          <button @click="open = !open" type="button" class="h-[40px] w-[40px] rounded-full border-2 border-gray-300 flex items-center justify-center cursor-pointer">
              <img src="{{ URL('images/person.png') }}" alt="User Icon" class="h-8 w-8 rounded-full">
          </button>
          <div x-show="open" @click.outside="open = false" class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden w-40 font-light z-10">
              <p class="flex items-center justify-center px-4 py-2">{{ ucfirst(auth()->user()->firstname) }}</p>
              <hr class="border-t border-gray-200">
              <a href="{{ route('user.dashboard') }}" class="flex items-center justify-center hover:bg-slate-100 py-2 mb-1">POS System</a>
              <a href="{{ route('user.transactions') }}" class="flex items-center justify-center hover:bg-slate-100 py-2 mb-1">Transaction</a>
              <a href="{{ route('user.warranty') }}" class="flex items-center justify-center hover:bg-slate-100  py-2 mb-1">Warranty</a>
              <form action="{{ route('logout') }}" method="post">
                  @csrf
                  <button type="submit" class="hover:bg-slate-100 flex items-center justify-center py-2 w-full mb-1 text-left">Logout</button>
              </form>
          </div>
        </div>
      </div>
      <form action="{{ route('user.updateSettings') }}" method="POST">
        @csrf
        <!-- Location Section -->
        <div class="md:flex mb-3">
          <div class="md:w-1/3">
            <legend class="uppercase tracking-wide text-sm">Profile</legend>
            <p class="text-xs font-light text-red">This entire section is required.</p>
          </div>
          <div class="md:flex-1 mb:mt-0 md:px-3">
            <div class="md:flex mb-4">
              <div class="md:flex-1 md:pr-3">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">First Name</label>
                <input class="w-full shadow-inner p-4 border-0" value="{{ old('firstname', $user->firstname) }}" type="text" name="firstname" placeholder="">
              </div>
              <div class="md:flex-1 md:pl-3">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Last Name</label>
                <input class="w-full shadow-inner p-4 border-0" value="{{ old('lastname', $user->lastname) }}" type="text" name="lastname" placeholder="">
              </div>
            </div>
          </div>
        </div>
        <!-- Contact Section -->
        <div class="md:flex mb-8">
          <div class="md:w-1/3">
            <legend class="uppercase tracking-wide text-sm">Contact</legend>
          </div>
          <div class="md:flex-1 mb:mt-0 md:px-3">
            <div class="md:flex mb-4">
              <div class="md:flex-1">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Email</label>
                <input class="w-full shadow-inner p-4 border-0" value="{{ old('email', $user->email) }}" type="text" name="email" placeholder="">
              </div>
            </div>
            <div class="md:flex mb-4">
              <div class="md:flex-1 md:pr-3">
              </div>
              <div class="md:flex-1 md:pl-3">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Phone</label>
                <input class="w-full shadow-inner p-4 border-0" value="{{ old('phone', $user->phone_number) }}"  type="text" name="phone" placeholder="">
              </div>
            </div>
          </div>
        </div>

        <div class="md:flex mb-8">
          <div class="md:w-1/3">
            <legend class="uppercase tracking-wide text-sm">Password</legend>
          </div>
          <div class="md:flex-1 mb:mt-0 md:px-3">
            <div class="md:flex mb-4">
              <div class="md:flex-1 md:pr-3">
                @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
              </div>
              <div class="md:flex-1 md:pl-3">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Current Password</label>
                <input class="w-full shadow-inner p-4 border-0" type="password" name="current_password" placeholder="">
              </div>
            </div>
            <div class="md:flex mb-4">
              <div class="md:flex-1 md:pr-3">
              </div>
              <div class="md:flex-1 md:pl-3">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">New Password</label>
                <input class="w-full shadow-inner p-4 border-0" type="password" name="new_password" placeholder="">
              </div>
            </div>
            <div class="md:flex mb-4">
              <div class="md:flex-1 md:pr-3">
              </div>
              <div class="md:flex-1 md:pl-3">
                <label class="block uppercase tracking-wide text-charcoal-darker text-xs font-bold">Confirm Password</label>
                <input class="w-full shadow-inner p-4 border-0" type="text" name="new_password_confirmation" placeholder="">
              </div>
            </div>
          </div>
        </div>   
        <div class="md:flex  border border-t-1 border-b-0 border-x-0 border-cream-dark">
          <div class="md:flex-1 pt-5 px-3 text-center md:text-right">
            <button class="py-2 px-6 border-2 text-white text-sm font-medium focus:outline-none bg-[#002F5B] rounded-lg border-gray-200 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="submit">
              Save
          </button>
          </div>
        </div>
      </form>
  </section>
</x-layoutstaff>
