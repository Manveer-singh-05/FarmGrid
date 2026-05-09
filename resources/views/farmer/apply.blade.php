@extends('layouts.main')

@section('main-content')
    <style>
        /* Enhanced hover effects */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(37, 99, 235, 0.25), 0 0 40px rgba(34, 197, 94, 0.2);
        }

        .hover-glow {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-glow:hover {
            border-color: rgba(56, 189, 248, 0.5);
            box-shadow: 0 0 30px rgba(56, 189, 248, 0.3);
        }

        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom form styling to match dashboard */
        .glassmorphic-input {
            @apply bg-slate-900/40 backdrop-blur-md border border-cyan-500/20 rounded-2xl text-white placeholder:text-slate-400;
        }

        .glassmorphic-input:focus {
            @apply border-cyan-400 ring ring-cyan-500/20 outline-none;
        }
    </style>
    <div class="max-w-4xl mx-auto">
        <!-- Premium Glass Card -->
        <div class="rounded-3xl p-8 smooth-transition"
            style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; box-shadow: 0 0 30px rgba(34, 197, 94, 0.15), 0 25px 80px rgba(37, 99, 235, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);">

            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center"
                    style="background: linear-gradient(135deg, rgba(56, 189, 248, 0.2) 0%, rgba(34, 197, 94, 0.2) 100%); border: 1px solid rgba(56, 189, 248, 0.4);">
                    <span class="text-2xl">⚡</span>
                </div>
                <div>
                    <h1
                        class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-emerald-400">
                        Apply for Electricity Connection
                    </h1>
                    <p class="text-slate-400 mt-2">
                        Submit your agricultural power connection request. Fill in the details below.
                    </p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('farmer.store') }}" method="POST" class="space-y-10">
                @csrf

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Village Name -->
                    <div>
                        <label class="block text-white/90 mb-4 font-medium flex items-center gap-3">
                            <span
                                class="w-7 h-7 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-sm">📍</span>
                            <span class="text-lg">Village Name</span>
                        </label>
                        <input type="text" name="village" required
                            class="w-full px-5 py-4 bg-slate-900/40 backdrop-blur-md border border-cyan-500/20 rounded-2xl text-white placeholder:text-slate-400 focus:border-cyan-400 focus:ring focus:ring-cyan-500/20 focus:outline-none transition-all duration-300"
                            placeholder="Enter your village name">
                    </div>

                    <!-- Land Area -->
                    <div>
                        <label class="block text-white/90 mb-4 font-medium flex items-center gap-3">
                            <span
                                class="w-7 h-7 rounded-full bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-sm">🌾</span>
                            <span class="text-lg">Land Area (acres)</span>
                        </label>
                        <input type="number" step="0.1" name="land_area" required
                            class="w-full px-5 py-4 bg-slate-900/40 backdrop-blur-md border border-cyan-500/20 rounded-2xl text-white placeholder:text-slate-400 focus:border-cyan-400 focus:ring focus:ring-cyan-500/20 focus:outline-none transition-all duration-300"
                            placeholder="e.g., 5.2">
                    </div>

                    <!-- Connection Number -->
                    <div>
                        <label class="block text-white/90 mb-4 font-medium flex items-center gap-3">
                            <span
                                class="w-7 h-7 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 text-sm">🔢</span>
                            <span class="text-lg">Connection Number</span>
                        </label>
                        <input type="text" name="connection_no" required
                            class="w-full px-5 py-4 bg-slate-900/40 backdrop-blur-md border border-cyan-500/20 rounded-2xl text-white placeholder:text-slate-400 focus:border-cyan-400 focus:ring focus:ring-cyan-500/20 focus:outline-none transition-all duration-300"
                            placeholder="Enter connection number">
                    </div>

                    <!-- Water Source -->
                    <div class="relative">
                        <label class="block text-white/90 mb-4 font-medium flex items-center gap-3">
                            <span
                                class="w-7 h-7 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400 text-sm">💧</span>
                            <span class="text-lg">Water Source</span>
                        </label>
                        <select name="water_source" required
                            class="w-full px-5 py-4 bg-slate-900/40 backdrop-blur-md border border-cyan-500/20 rounded-2xl text-white focus:border-cyan-400 focus:ring focus:ring-cyan-500/20 focus:outline-none transition-all duration-300 appearance-none">
                            <option value="" class="bg-slate-900 text-white">Select water source...</option>
                            <option value="tube_well" class="bg-slate-900 text-white">Tube Well</option>
                            <option value="borewell" class="bg-slate-900 text-white">Borewell</option>
                            <option value="canal" class="bg-slate-900 text-white">Canal</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-cyan-400/80">
                            <span class="text-sm">▼</span>
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div>
                    <label class="block text-white/90 mb-4 font-medium flex items-center gap-3">
                        <span
                            class="w-7 h-7 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-400 text-sm">📝</span>
                        <span class="text-lg">Additional Notes (Optional)</span>
                    </label>
                    <textarea name="notes" rows="4"
                        class="w-full px-5 py-4 bg-slate-900/40 backdrop-blur-md border border-cyan-500/20 rounded-2xl text-white placeholder:text-slate-400 focus:border-cyan-400 focus:ring focus:ring-cyan-500/20 focus:outline-none transition-all duration-300 resize-none"
                        placeholder="Any additional information about your application..."></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap gap-6 pt-10 border-t border-slate-800/50">
                    <button type="submit"
                        class="px-12 py-5 rounded-xl font-bold text-white bg-gradient-to-r from-cyan-500 to-emerald-500 hover:from-cyan-600 hover:to-emerald-600 shadow-2xl shadow-cyan-500/30 hover:shadow-cyan-500/50 transition-all duration-300 flex items-center gap-3 group hover:translate-y-[-4px] hover:scale-[1.02] smooth-transition">
                        <span class="text-xl">✓</span>
                        <span>Submit Application</span>
                        <span class="group-hover:translate-x-1 transition-transform">→</span>
                    </button>
                    <a href="{{ route('farmer.dashboard') }}"
                        class="px-12 py-5 rounded-xl font-bold text-white border border-cyan-500/30 bg-slate-900/40 backdrop-blur-md hover:bg-slate-900/60 hover:border-cyan-400/50 hover:shadow-lg hover:shadow-cyan-500/20 transition-all duration-300 flex items-center gap-3 smooth-transition">
                        <span>←</span>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Helper Text -->
        <div
            class="mt-10 p-6 text-center text-slate-300 text-base rounded-2xl bg-slate-900/30 backdrop-blur-md border border-cyan-500/10">
            <p class="font-medium">Your application will be reviewed within 3–5 working days. You'll receive a notification
                once approved.</p>
        </div>
    </div>
@endsection