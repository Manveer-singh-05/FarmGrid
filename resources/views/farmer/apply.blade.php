@extends('layouts.main')

@section('main-content')
    <style>
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(56, 189, 248, 0.4)); }
            50% { filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.7)); }
        }
        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.6) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 
                        inset 0 1px 1px rgba(255, 255, 255, 0.05);
        }

        .glass-input {
            background: rgba(2, 6, 23, 0.4) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            color: #f8fafc !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-input:focus {
            background: rgba(2, 6, 23, 0.6) !important;
            border-color: #38bdf8 !important;
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.2), inset 0 0 10px rgba(56, 189, 248, 0.1);
            outline: none;
            transform: scale(1.01);
        }

        .glass-input::placeholder {
            color: rgba(148, 163, 184, 0.6);
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -100%;
            width: 100%;
            height: 200%;
            background: linear-gradient(
                to right,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transform: rotate(30deg);
            animation: shine 4s infinite;
        }

        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.3));
        }

        select option {
            background-color: #0f172a;
            color: white;
        }
    </style>

    <div class="max-w-4xl mx-auto py-8">
        <!-- Main Form Card -->
        <div class="glass-card rounded-[32px] p-10 float-animation">
            
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row items-center gap-6 mb-12 border-b border-white/5 pb-10">
                <div class="w-20 h-20 rounded-3xl flex items-center justify-center text-4xl shadow-2xl pulse-glow"
                     style="background: linear-gradient(135deg, rgba(56, 189, 248, 0.2) 0%, rgba(16, 185, 129, 0.2) 100%); border: 1px solid rgba(56, 189, 248, 0.4);">
                    ⚡
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white mb-3">
                        Apply for <span style="background: linear-gradient(135deg, #38bdf8 0%, #10b981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Connection</span>
                    </h1>
                    <p class="text-slate-400 text-lg max-w-xl">
                        Powering your agricultural growth. Submit your smart-grid connection request through our secure portal.
                    </p>
                </div>
            </div>

            <form action="{{ route('farmer.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Village Name -->
                    <div class="space-y-3">
                        <label class="flex items-center gap-2 text-slate-300 font-semibold text-sm uppercase tracking-wider ml-1">
                            <span class="text-sky-400">📍</span> Village / Location
                        </label>
                        <input type="text" name="village" required
                               class="glass-input w-full px-6 py-4 rounded-2xl text-lg"
                               placeholder="e.g., Green Valley Village">
                    </div>

                    <!-- Land Area -->
                    <div class="space-y-3">
                        <label class="flex items-center gap-2 text-slate-300 font-semibold text-sm uppercase tracking-wider ml-1">
                            <span class="text-emerald-400">🌾</span> Total Land Area (Acres)
                        </label>
                        <input type="number" step="0.1" name="land_area" required
                               class="glass-input w-full px-6 py-4 rounded-2xl text-lg"
                               placeholder="e.g., 12.5">
                    </div>

                    <!-- Connection Number -->
                    <div class="space-y-3">
                        <label class="flex items-center gap-2 text-slate-300 font-semibold text-sm uppercase tracking-wider ml-1">
                            <span class="text-blue-400">🔢</span> Target Connection ID
                        </label>
                        <input type="text" name="connection_no" required
                               class="glass-input w-full px-6 py-4 rounded-2xl text-lg"
                               placeholder="Enter your system ID">
                    </div>

                    <!-- Water Source -->
                    <div class="space-y-3">
                        <label class="flex items-center gap-2 text-slate-300 font-semibold text-sm uppercase tracking-wider ml-1">
                            <span class="text-cyan-400">💧</span> Primary Water Source
                        </label>
                        <div class="relative">
                            <select name="water_source" required
                                    class="glass-input w-full px-6 py-4 rounded-2xl text-lg appearance-none cursor-pointer">
                                <option value="" disabled selected>Select Source...</option>
                                <option value="tube_well">Tube Well</option>
                                <option value="borewell">Borewell</option>
                                <option value="canal">Canal Irrigation</option>
                                <option value="other">Other Sources</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-sky-400">
                                ⌵
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="space-y-3">
                    <label class="flex items-center gap-2 text-slate-300 font-semibold text-sm uppercase tracking-wider ml-1">
                        <span class="text-amber-400">📝</span> Application Context (Optional)
                    </label>
                    <textarea name="notes" rows="4"
                              class="glass-input w-full px-6 py-4 rounded-2xl text-lg resize-none"
                              placeholder="Describe your power requirements or any special requests..."></textarea>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-12 border-t border-white/5 mt-10">
                    <a href="{{ route('farmer.dashboard') }}" 
                       class="order-2 sm:order-1 flex items-center gap-2 text-slate-400 hover:text-white font-bold transition-all duration-300 group">
                        <span class="group-hover:-translate-x-1 transition-transform">←</span> Return to Dashboard
                    </a>

                    <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto order-1 sm:order-2">
                        <button type="submit" 
                                class="btn-shine px-10 py-5 rounded-2xl font-black text-white bg-gradient-to-r from-sky-500 to-emerald-500 hover:from-sky-400 hover:to-emerald-400 shadow-[0_0_20px_rgba(56,189,248,0.3)] hover:shadow-[0_0_35px_rgba(56,189,248,0.5)] transition-all duration-300 flex items-center justify-center gap-3 hover:-translate-y-1">
                            <span>Submit Application</span>
                            <span class="text-xl">➔</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- System Message -->
        <div class="mt-8 p-6 rounded-3xl glass-card flex items-start gap-4 border-dashed border-sky-500/20">
            <div class="text-2xl text-sky-400">💡</div>
            <p class="text-slate-400 text-sm leading-relaxed">
                <strong class="text-white">Smart Audit Information:</strong> Applications are processed by the regional grid controllers. Verification typically completes within <span class="text-emerald-400">72 hours</span>. Ensure your land area matches the records on your assets.
            </p>
        </div>
    </div>
@endsection