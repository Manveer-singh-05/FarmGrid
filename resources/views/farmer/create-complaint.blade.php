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
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .glass-panel {
            background: rgba(15, 23, 42, 0.6) !important;
            backdrop-filter: blur(25px);
            border: 1px solid rgba(56, 189, 248, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 
                        inset 0 1px 1px rgba(255, 255, 255, 0.05);
            border-radius: 32px;
        }

        .glass-field {
            background: rgba(2, 6, 23, 0.4) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            color: #f8fafc !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 16px;
        }

        .glass-field:focus {
            background: rgba(2, 6, 23, 0.6) !important;
            border-color: #38bdf8 !important;
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.2), inset 0 0 10px rgba(56, 189, 248, 0.1);
            outline: none;
            transform: scale(1.01);
        }

        .glass-field::placeholder {
            color: rgba(148, 163, 184, 0.5);
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

        .form-label {
            color: #cbd5e1;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: block;
            margin-left: 4px;
        }

        select option {
            background-color: #0f172a;
            color: white;
        }
    </style>

    <div class="max-w-2xl mx-auto py-12">
        <!-- Main Form Panel -->
        <div class="glass-panel p-10 float-animation">
            
            <!-- Header Section -->
            <div class="flex flex-col items-center text-center mb-12">
                <div class="w-20 h-20 rounded-3xl bg-slate-800/50 border border-sky-500/30 flex items-center justify-center text-4xl shadow-2xl pulse-glow mb-6">
                    🔧
                </div>
                <h2 class="text-4xl font-black tracking-tight text-white mb-3">
                    Report a <span style="background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Complaint</span>
                </h2>
                <p class="text-slate-400 text-lg font-medium">
                    Submit electricity-related issues for quick regional resolution.
                </p>
            </div>

            <form action="{{ route('farmer.complaint.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Complaint Type -->
                <div class="space-y-2">
                    <label class="form-label">
                        <span class="text-sky-400 mr-2">Category</span> Complaint Type
                    </label>
                    <div class="relative">
                        <select name="complaint_type" required class="glass-field w-full px-6 py-4 text-lg appearance-none cursor-pointer">
                            <option value="" disabled selected>Select issue category...</option>
                            <option value="no_electricity">No Electricity Supply</option>
                            <option value="low_voltage">Low Voltage</option>
                            <option value="transformer_issue">Transformer Problem</option>
                            <option value="line_fault">Line Fault</option>
                            <option value="billing_issue">Billing Issue</option>
                            <option value="meter_problem">Meter Problem</option>
                            <option value="other">Other Issues</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-sky-400">
                            ⌵
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="form-label">
                        <span class="text-emerald-400 mr-2">Details</span> Problem Description
                    </label>
                    <textarea name="description" rows="5" required 
                              class="glass-field w-full px-6 py-4 text-lg resize-none"
                              placeholder="Please provide specific details about the issue..."></textarea>
                </div>

                <!-- Priority -->
                <div class="space-y-2">
                    <label class="form-label">
                        <span class="text-amber-400 mr-2">Priority</span> Urgency Level
                    </label>
                    <div class="relative">
                        <select name="priority" class="glass-field w-full px-6 py-4 text-lg appearance-none cursor-pointer">
                            <option value="low">Low - Routine Issue</option>
                            <option value="medium" selected>Medium - Standard Priority</option>
                            <option value="high">High - Urgent Response</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-sky-400">
                            ⌵
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-10 border-t border-white/5 mt-6">
                    <a href="{{ route('farmer.complaints') }}" 
                       class="order-2 sm:order-1 text-slate-400 hover:text-white font-bold transition-all duration-300 flex items-center gap-2 group">
                        <span class="group-hover:-translate-x-1 transition-transform">←</span> Back to List
                    </a>

                    <button type="submit" 
                            class="btn-shine order-1 sm:order-2 w-full sm:w-auto px-10 py-5 rounded-2xl font-black text-white bg-gradient-to-r from-emerald-500 to-sky-500 hover:from-emerald-400 hover:to-sky-400 shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_35px_rgba(16,185,129,0.5)] transition-all duration-300 flex items-center justify-center gap-3 hover:-translate-y-1">
                        <span>Submit Complaint</span>
                        <span class="text-xl">➔</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- System Policy Card -->
        <div class="mt-8 p-6 glass-panel flex items-start gap-5 border-dashed border-emerald-500/20">
            <div class="text-3xl">🛡️</div>
            <p class="text-slate-400 text-sm leading-relaxed">
                <strong class="text-white block mb-1">Resolution Protocol:</strong> 
                Once submitted, your request is assigned a unique tracking ID and routed to the regional grid team. Most issues are diagnosed within <span class="text-sky-400">12-24 hours</span>. Please keep your connection details ready for verification.
            </p>
        </div>
    </div>
@endsection