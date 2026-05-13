<header class="bg-white border-b border-gray-100 py-3 px-6 md:px-10 sticky top-0 z-40">
    <div class="flex items-center justify-between">
        
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="md:hidden text-gray-500 hover:text-[#4D9BE2] p-2 rounded-xl hover:bg-[#F3F7FB] transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <div class="shadow-sm text-md text-[#4D9BE2] py-2 rounded-xl font-semibold self-start md:self-center">
                🗓️ {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <div class="flex items-center gap-2 md:gap-2">
            
            <button class="relative p-3 rounded-2xl bg-[#F3F7FB] text-[#4D9BE2] hover:bg-[#e6f0f8] hover:scale-105 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>

            <div class="h-8 w-[1px] bg-gray-100 mx-1"></div>

            <div x-data="{ open: false }" @click.away="open = false" class="relative py-1">
                
            <button @click="open = !open" class="flex items-center gap-3 p-1.5 rounded-2xl hover:bg-gray-50 transition-all duration-300 focus:outline-none">
                <div class="h-10 w-10 md:h-11 md:w-11 rounded-full bg-[#4D9BE2] flex items-center justify-center text-white font-bold border-2 border-[#4D9BE2]/20 shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                
                <div class="text-left hidden md:block leading-tight">
                    <p class="text-sm font-bold text-[#2F3951]">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-400 font-medium capitalize mt-0.5">{{ Auth::user()->role }} MacaBae</p>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-4 w-4 text-gray-400 transition-transform duration-300 ease-in-out" 
                    :style="open ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'"
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
                     x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="transform opacity-0 scale-95 translate-y-2"
                     class="absolute right-0 top-full pt-2 w-56 z-50"
                     style="display: none;">
                     
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-2">
                        <div class="px-4 py-3 border-b border-gray-50 mb-1">
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Pengaturan Akun</p>
                        </div>
                        
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#F3F7FB] hover:text-[#4D9BE2] transition-all group/item">
                            <div class="p-2 rounded-lg bg-gray-50 group-hover/item:bg-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Profil Lengkap</span>
                        </a>

                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-[#F3F7FB] hover:text-[#4D9BE2] transition-all group/item">
                            <div class="p-2 rounded-lg bg-gray-50 group-hover/item:bg-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Ubah Password</span>
                        </a>

                        <div class="my-1 border-t border-gray-50"></div>

                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 transition-all font-semibold text-left">
                                <div class="p-2 rounded-lg bg-red-100/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </div>
                                <span class="text-sm">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>