<footer class="bg-slate-900 text-white mt-auto border-t border-white/5 relative overflow-hidden">
    <!-- Subtle Indigo Glow Effect -->
    <div class="absolute -bottom-24 -left-24 h-64 w-64 bg-indigo-600/10 rounded-full blur-3xl opacity-50"></div>

    <div class="container mx-auto px-6 py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-start">
            
            <!-- Column 1: Brand Identity -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3 group">
                    <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-600/20 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-black tracking-tighter uppercase italic">AutoMate <span class="text-indigo-500">Service</span></span>
                </div>
                <p class="text-gray-400 text-xs font-medium leading-relaxed max-w-xs">
                    Advancing automotive care through intelligent diagnostic frameworks and verified maintenance ledgers.
                </p>
                <!-- System Status Badge -->
                <div class="inline-flex items-center space-x-2 px-3 py-1.5 bg-emerald-500/10 border border-emerald-500/20 rounded-full">
                    <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">AI Engine: Operational</span>
                </div>
            </div>

            <!-- Column 2: Quick Navigation -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-6">Platform</p>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-xs font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">Dashboard</a></li>
                        <li><a href="{{ route('cars.index') }}" class="text-xs font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">My Garage</a></li>
                    </ul>
                </div>
                <div class="space-y-4 pt-10">
                    <ul class="space-y-3">
                        <li><a href="{{ route('ai.index') }}" class="text-xs font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">AI Health Check</a></li>
                        <li><a href="{{ route('profile.show') }}" class="text-xs font-bold text-gray-500 hover:text-white transition-colors uppercase tracking-widest">Settings</a></li>
                    </ul>
                </div>
            </div>

            <!-- Column 3: Global Footer Info -->
            <div class="flex flex-col md:items-end space-y-6">
                <div class="text-center md:text-right">
                    <p class="text-white font-black text-[10px] uppercase tracking-[0.3em] mb-2 opacity-50">Secure Ledger Access</p>
                    <div class="text-white/40 text-[10px] font-bold uppercase tracking-widest leading-loose">
                        &copy; {{ date('Y') }} AutoMate Car Service <br> 
                        <span class="text-indigo-600/60">Malaysia Digital Diagnostic Unit</span>
                    </div>
                </div>
                
                <!-- Social / Utility Icons -->
                <div class="flex items-center space-x-4">
                    <div class="h-8 w-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-gray-500 hover:text-indigo-400 hover:border-indigo-400 transition-all cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div class="h-8 w-8 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-gray-500 hover:text-indigo-400 hover:border-indigo-400 transition-all cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Border & Copyright Label -->
        <div class="mt-16 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[8px] font-black text-gray-600 uppercase tracking-[0.4em]">All Data Processing Compliant with System Protocol v1.0</p>
            <p class="text-[8px] font-black text-gray-600 uppercase tracking-[0.4em]">Designed for Performance</p>
        </div>
    </div>
</footer>