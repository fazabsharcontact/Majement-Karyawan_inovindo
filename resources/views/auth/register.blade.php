<x-guest-layout>
    <div class="min-h-screen w-full flex flex-col lg:flex-row bg-white">

        <!-- LEFT PANEL -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-12">

            <!-- Logo Mobile -->
            <div class="flex justify-center lg:justify-start lg:ml-16 mb-6 lg:mb-0">
                <img src="{{ asset('images/inovindo.webp') }}" alt="Logo" class="h-14 lg:h-12">
            </div>

            <!-- Title -->
            <div class="mb-10 lg:ml-16 text-center lg:text-left">
                <h1 class="text-3xl font-bold tracking-tight">Create your account</h1>
                <p class="text-gray-500 mt-2 text-sm">
                    Join us and start your journey today.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div class="flex flex-col items-center">
                    <label class="self-start lg:self-start text-sm font-medium text-gray-700 lg:ml-16">
                        Name
                    </label>
                    <input type="text" name="name"
                        value="{{ old('name') }}"
                        class="mt-1 w-full lg:w-[80%] px-4 py-2 rounded-lg border border-gray-300
                        focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="Enter your full name" required>
                </div>

                <!-- Email -->
                <div class="flex flex-col items-center">
                    <label class="self-start lg:self-start text-sm font-medium text-gray-700 lg:ml-16">
                        Email
                    </label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="mt-1 w-full lg:w-[80%] px-4 py-2 rounded-lg border border-gray-300 
                        focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="Enter your email" required>
                </div>

                <!-- Password -->
                <div class="flex flex-col items-center">
                    <label class="self-start lg:self-start text-sm font-medium text-gray-700 lg:ml-16">
                        Password
                    </label>
                    <input type="password" name="password"
                        class="mt-1 w-full lg:w-[80%] px-4 py-2 rounded-lg border border-gray-300 
                        focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="••••••••" required>
                </div>

                <!-- Confirm -->
                <div class="flex flex-col items-center">
                    <label class="self-start lg:self-start text-sm font-medium text-gray-700 lg:ml-16">
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation"
                        class="mt-1 w-full lg:w-[80%] px-4 py-2 rounded-lg border border-gray-300 
                        focus:ring-2 focus:ring-black focus:outline-none"
                        placeholder="••••••••" required>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full lg:w-[80%] bg-black text-white font-semibold py-3 rounded-xl 
                        hover:bg-gray-800 transition mx-auto block">
                    Create Account
                </button>

                <!-- Divider -->
                <div class="flex items-center my-4">
                    <div class="flex-1 h-[1px] bg-gray-200"></div>
                    <span class="px-4 text-gray-400 text-sm">OR</span>
                    <div class="flex-1 h-[1px] bg-gray-200"></div>
                </div>

                <p class="text-center text-sm text-gray-600 mt-3">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-red-400 font-semibold hover:underline">
                        Login
                    </a>
                </p>
            </form>

            <!-- MOBILE IMAGE PANEL -->
            <div class="lg:hidden mt-10">
                <div class="w-full h-64 rounded-2xl bg-cover bg-center bg-no-repeat relative overflow-hidden"
                    style="background-image: url('{{ asset('images/login-bg.jpeg') }}')">

                    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm p-5 flex flex-col justify-end">
                        
                        <div class="flex gap-2 mb-3">
                            <span class="px-3 py-1 rounded-lg text-xs bg-white/10 border border-white/20 text-white">
                                Software House
                            </span>
                            <span class="px-3 py-1 rounded-lg text-xs bg-white/10 border border-white/20 text-white">
                                Web & Mobile Development
                            </span>
                        </div>

                        <p class="text-white text-sm leading-relaxed">
                            “Technology is best when it brings people together.”
                        </p>
                        <p class="text-white font-semibold mt-3">Matt Mullenweg</p>
                        <p class="text-gray-300 text-xs">Founder of WordPress</p>

                    </div>
                </div>
            </div>
        </div>

        <!-- DESKTOP RIGHT PANEL -->
        <div class="hidden lg:flex w-[700px] h-[800px] items-center justify-center p-10 bg-white">
            <div class="rounded-3xl p-8 shadow-xl flex flex-col justify-end gap-6
                        bg-cover bg-center bg-no-repeat text-white h-full w-full"
                style="background-image: url('{{ asset('images/login-bg.jpeg') }}')">

                <div class="text-sm text-gray-300 flex gap-2">
                    <span class="px-3 py-1 rounded-lg text-xs 
                                bg-white/10 backdrop-blur-md border border-white/20 shadow-lg">
                        Software House
                    </span>
                    <span class="px-3 py-1 rounded-lg text-xs
                                bg-white/10 backdrop-blur-md border border-white/20 shadow-lg">
                        Web & Mobile Development
                    </span>
                </div>

                <div class="h-48 w-full rounded-2xl bg-white/10 backdrop-blur-xl 
                            border border-white/20 shadow-2xl">
                    <p class="mt-4 text-lg leading-relaxed p-5">
                        “Technology is best when it brings people together.”
                    </p>
                    <div class="p-5">
                        <p class="font-semibold">Matt Mullenweg</p>
                        <p class="text-gray-400 text-sm">Founder of WordPress</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>