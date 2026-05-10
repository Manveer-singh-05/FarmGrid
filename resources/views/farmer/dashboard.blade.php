@extends('layouts.main')

@section('main-content')
    <style>
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes slide-in-right {
            from { transform: translateX(20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
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
        
        .animated-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 8s ease infinite;
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
        
        .slide-in-right {
            animation: slide-in-right 0.6s ease-out;
        }
        
        /* Smooth transitions for all interactive elements */
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @media (max-width: 1024px) {
            .responsive-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .responsive-two-col {
                grid-template-columns: 1fr !important;
            }
            .responsive-chart-grid {
                grid-template-columns: 1fr !important;
            }
            .responsive-stats-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .responsive-quick-actions {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        @media (max-width: 768px) {
            .responsive-grid {
                grid-template-columns: 1fr !important;
            }
            .responsive-stats-grid {
                grid-template-columns: 1fr !important;
            }
            .responsive-quick-actions {
                grid-template-columns: 1fr !important;
            }
            .hero-padding {
                padding: 32px 24px !important;
            }
            .card-padding {
                padding: 24px 20px !important;
            }
            .hide-on-mobile {
                display: none !important;
            }
            .mobile-stack {
                flex-direction: column !important;
                gap: 16px !important;
            }
        }
        @media (max-width: 480px) {
            .hero-padding {
                padding: 24px 16px !important;
            }
            .card-padding {
                padding: 20px 16px !important;
            }
        }
    </style>
    
    <div style="display: flex; flex-direction: column; gap: 28px;">
        <!-- Hero Section -->
        <div
            style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 32px; padding: 48px; box-shadow: 0 0 40px rgba(34, 197, 94, 0.2), 0 25px 80px rgba(37, 99, 235, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.1); position: relative; overflow: hidden;">
            <div
                style="position: absolute; top: -40%; right: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%); border-radius: 50%; filter: blur(60px); pointer-events: none;">
            </div>
            <div
                style="position: absolute; bottom: -20%; left: 5%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); border-radius: 50%; filter: blur(60px); pointer-events: none;">
            </div>
            <div style="position: relative; z-index: 1;">
                <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 12px;">Welcome back, <span
                        style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ explode(' ', Auth::user()->name)[0] }}
                        👋</span></h2>
                <p style="color: #cbd5e1; font-size: 1.2rem; margin-bottom: 32px; max-width: 800px;">Manage your
                    agricultural electricity efficiently with FarmGrid's smart distribution system.</p>

                <!-- Status Badges & Connection Switcher -->
                <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 24px; align-items: center;">
                    @if($connections->count() > 1)
                        <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(56, 189, 248, 0.3); padding: 8px 16px; border-radius: 16px; display: flex; align-items: center; gap: 12px; backdrop-filter: blur(10px);">
                            <span style="color: #94a3b8; font-size: 0.85rem; font-weight: 700;">SWITCH CONNECTION:</span>
                            <select onchange="window.location.href='?connection_id='+this.value" 
                                    style="background: transparent; color: #38BDF8; border: none; font-weight: 800; font-size: 0.95rem; cursor: pointer; outline: none;">
                                @foreach($connections as $conn)
                                    <option value="{{ $conn->id }}" {{ $farmer->id == $conn->id ? 'selected' : '' }} style="background: #0f172a; color: #f1f5f9;">
                                        {{ $conn->connection_no }} ({{ $conn->village }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($farmer)
                        <div style="background: rgba(56, 189, 248, 0.15); border: 1px solid rgba(56, 189, 248, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(56, 189, 248, 0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <span style="color: #38BDF8; font-size: 1.2rem;">⚡</span>
                            <div>
                                <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">Connection Status</p>
                                <p style="font-size: 1rem; font-weight: 700; color: #38BDF8; margin: 0;">
                                    {{ ucfirst($farmer->status) }}</p>
                            </div>
                        </div>
                    @endif

                    <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(34, 197, 94, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <span style="color: #10B981; font-size: 1.2rem;">🔋</span>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">Power Availability
                            </p>
                            <p style="font-size: 1rem; font-weight: 700; color: #10B981; margin: 0;">
                                {{ $schedules->where('status', 'active')->count() > 0 ? 'Available Now' : 'Scheduled' }}</p>
                        </div>
                    </div>

                    <div style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(245, 158, 11, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <span style="color: #F59E0B; font-size: 1.2rem;">📅</span>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">Active Schedule</p>
                            <p style="font-size: 1rem; font-weight: 700; color: #F59E0B; margin: 0;">
                                {{ $schedules->where('zone', $farmer->village)->where('status', 'active')->count() }} Active</p>
                        </div>
                    </div>

                    <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(239, 68, 68, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <span style="color: #EF4444; font-size: 1.2rem;">⚠️</span>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">Pending Issues</p>
                            <p style="font-size: 1rem; font-weight: 700; color: #EF4444; margin: 0;">
                                {{ $complaints->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Row -->
                <div
                    style="display: flex; gap: 24px; flex-wrap: wrap; padding-top: 16px; border-top: 1px solid rgba(56, 189, 248, 0.1);">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #38BDF8;">●</span>
                        <span style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9;">System Live</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #10B981;">🛡️</span>
                        <span style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9;">Secure Distribution</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #8B5CF6;">📊</span>
                        <span style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9;">Real-time Monitoring</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #F59E0B;">⚡</span>
                        <span style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9;">Smart Grid Enabled</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="responsive-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(34, 197, 94, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3
                            style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Connection Status</h3>
                        @if($farmer)
                            <p
                                style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">
                                {{ ucfirst($farmer->status) }}</p>
                            <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">ID: {{ $farmer->connection_no }}
                            </p>
                        @else
                            <a href="{{ route('farmer.apply') }}"
                                style="color: #38BDF8; font-weight: 600; text-decoration: none; font-size: 1.1rem; display: block; margin-top: 8px;">Apply
                                Now →</a>
                        @endif
                    </div>
                    <div class="float-animation" style="font-size: 2.25rem; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">⚡</div>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(245, 158, 11, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3
                            style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Pending Issues</h3>
                        <p
                            style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #F59E0B 0%, #EF4444 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">
                            {{ $complaints->where('status', 'pending')->count() }}</p>
                        <a href="{{ route('farmer.complaints') }}"
                            style="color: #F59E0B; font-size: 0.85rem; font-weight: 600; text-decoration: none;">View Detail
                            →</a>
                    </div>
                    <div class="float-animation" style="font-size: 2.25rem; filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.3));">🔧</div>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(56, 189, 248, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3
                            style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Monthly Usage</h3>
                        @if($powerUsage)
                            <p
                                style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #3B82F6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">
                                {{ $powerUsage->units_consumed }} <span style="font-size: 1.25rem;">kWh</span></p>
                            <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Bill:
                                ₹{{ $powerUsage->bill_amount }}</p>
                        @else
                            <p style="color: #64748b; font-size: 1.1rem; font-weight: 600; margin-top: 8px;">No Data</p>
                        @endif
                    </div>
                    <div class="float-animation" style="font-size: 2.25rem; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">📈</div>
                </div>
            </div>

            <!-- Fourth Card: Electricity Availability -->
            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(168, 85, 247, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3
                            style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Electricity Availability</h3>
                        @if($schedules->where('status', 'active')->count() > 0)
                            <p
                                style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #A855F7 0%, #EC4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">
                                {{ $schedules->where('status', 'active')->count() }} Zones</p>
                            <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">
                                {{ $schedules->where('status', 'active')->first()->start_time ?? 'N/A' }} -
                                {{ $schedules->where('status', 'active')->first()->end_time ?? 'N/A' }}</p>
                        @else
                            <p
                                style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #A855F7 0%, #EC4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">
                                No Active</p>
                            <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Check schedule for timings</p>
                        @endif
                    </div>
                    <div class="float-animation" style="font-size: 2.25rem; filter: drop-shadow(0 0 10px rgba(168, 85, 247, 0.3));">🔌</div>
                </div>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); margin-top: 24px;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">🚀 Quick Actions</h3>
            <div class="responsive-quick-actions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <a href="{{ route('farmer.apply') }}"
                   class="hover-lift smooth-transition" style="background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 18px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                   <span class="float-animation" style="font-size: 2.5rem; margin-bottom: 12px;">✋</span>
                    <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px;">Apply Connection</h4>
                    <p style="color: #94a3b8; font-size: 0.85rem; text-align: center;">Request new electricity connection</p>
                </a>
                
                <a href="{{ route('farmer.complaint.create') }}"
                   class="hover-lift smooth-transition" style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 18px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                   <span class="float-animation" style="font-size: 2.5rem; margin-bottom: 12px;">🔧</span>
                    <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px;">Raise Complaint</h4>
                    <p style="color: #94a3b8; font-size: 0.85rem; text-align: center;">Report issues or malfunctions</p>
                </a>
                
                <a href="{{ route('farmer.schedules') }}"
                   class="hover-lift smooth-transition" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 18px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                   <span class="float-animation" style="font-size: 2.5rem; margin-bottom: 12px;">📅</span>
                    <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px;">View Schedule</h4>
                    <p style="color: #94a3b8; font-size: 0.85rem; text-align: center;">Check electricity timings</p>
                </a>
                
                <a href="{{ route('farmer.usage') }}"
                   class="hover-lift smooth-transition" style="background: rgba(168, 85, 247, 0.1); border: 1px solid rgba(168, 85, 247, 0.3); border-radius: 18px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                   <span class="float-animation" style="font-size: 2.5rem; margin-bottom: 12px;">📊</span>
                    <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px;">Usage Analytics</h4>
                    <p style="color: #94a3b8; font-size: 0.85rem; text-align: center;">Detailed power consumption</p>
                </a>
            </div>
        </div>

        <div class="responsive-two-col" style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 28px;">
            <!-- Electricity Schedule - Modern Timeline -->
            <div
                style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                    <h3
                        style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px;">
                        📅 Today's Electricity Schedule</h3>
                    <a href="{{ route('farmer.schedules') }}"
                        style="color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); transition: all 0.3s ease;"
                        onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='0 0 15px rgba(56, 189, 248, 0.3)'"
                        onmouseout="this.style.background='transparent'; this.style.boxShadow='none'">View All</a>
                </div>

                @if($schedules->count() > 0)
                    <div style="position: relative;">
                        <!-- Timeline line -->
                        <div
                            style="position: absolute; left: 24px; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, rgba(56, 189, 248, 0.3), rgba(34, 197, 94, 0.3)); border-radius: 2px;">
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 24px; padding-left: 56px;">
                            @foreach($schedules as $schedule)
                                <div style="position: relative;">
                                    <!-- Timeline dot -->
                                    <div
                                        style="position: absolute; left: -40px; top: 8px; width: 16px; height: 16px; border-radius: 50%; background: {{ $schedule->status === 'active' ? '#10B981' : '#EF4444' }}; box-shadow: 0 0 15px {{ $schedule->status === 'active' ? 'rgba(16, 185, 129, 0.5)' : 'rgba(239, 68, 68, 0.5)' }}; z-index: 2;">
                                    </div>

                                    <!-- Schedule card -->
                                    <div style="background: rgba(255, 255, 255, 0.03); border-radius: 18px; padding: 20px; border: 1px solid {{ $schedule->status === 'active' ? 'rgba(34, 197, 94, 0.3)' : 'rgba(239, 68, 68, 0.3)' }}; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.transform='translateX(8px)'; this.style.background='rgba(255,255,255,0.06)'; this.style.boxShadow='0 10px 30px {{ $schedule->status === 'active' ? 'rgba(34, 197, 94, 0.2)' : 'rgba(239, 68, 68, 0.2)' }}'"
                                        onmouseout="this.style.transform='translateX(0)'; this.style.background='rgba(255,255,255,0.03)'; this.style.boxShadow='none'">
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                            <div>
                                                <h4
                                                    style="font-size: 1.1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 4px;">
                                                    {{ $schedule->zone }} 
                                                    @if($schedule->farmer_id)
                                                        <span style="font-size: 0.7rem; color: #38BDF8; font-weight: 500;">(Conn: {{ $schedule->farmer->connection_no }})</span>
                                                    @else
                                                        <span style="font-size: 0.7rem; color: #94a3b8; font-weight: 500;">(Grid Zone)</span>
                                                    @endif
                                                </h4>
                                                <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 500;">
                                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
                                            </div>
                                            <span
                                                style="display: inline-block; padding: 6px 14px; border-radius: 100px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; {{ $schedule->status === 'active' ? 'background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.4);' : 'background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.4);' }}">
                                                {{ $schedule->status === 'active' ? '⚡ Active' : '⏸️ Inactive' }}
                                            </span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="display: flex; align-items: center; gap: 6px;">
                                                <span style="color: #38BDF8;">⏱️</span>
                                                <span style="color: #cbd5e1; font-size: 0.85rem;">Duration:
                                                    {{ \Carbon\Carbon::parse($schedule->start_time)->diffInHours(\Carbon\Carbon::parse($schedule->end_time)) }}h</span>
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 6px;">
                                                <span style="color: #10B981;">🔋</span>
                                                <span style="color: #cbd5e1; font-size: 0.85rem;">Power:
                                                    {{ $schedule->status === 'active' ? 'Available' : 'Not Available' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Summary -->
                    <div
                        style="margin-top: 32px; padding: 20px; background: rgba(56, 189, 248, 0.05); border-radius: 16px; border: 1px solid rgba(56, 189, 248, 0.1);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p style="color: #cbd5e1; font-size: 0.9rem; font-weight: 600;">Today's Power Availability</p>
                                <p style="color: #f1f5f9; font-size: 1.1rem; font-weight: 700;">
                                    {{ $schedules->where('status', 'active')->count() }} active zones •
                                    {{ $schedules->where('status', 'inactive')->count() }} scheduled
                                </p>
                            </div>
                            <div
                                style="padding: 8px 16px; background: rgba(34, 197, 94, 0.1); border-radius: 10px; border: 1px solid rgba(34, 197, 94, 0.3);">
                                <span
                                    style="color: #4ade80; font-weight: 700; font-size: 0.9rem;">{{ $schedules->where('status', 'active')->count() > 0 ? 'Power ON' : 'Power OFF' }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        <span
                            style="font-size: 3rem; display: block; margin-bottom: 16px; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">📭</span>
                        <h4 style="font-size: 1.2rem; font-weight: 700; color: #cbd5e1; margin-bottom: 8px;">No schedules for
                            today</h4>
                        <p style="color: #94a3b8; font-size: 0.95rem;">Check back later or contact admin for schedule updates.
                        </p>
                        <a href="{{ route('farmer.schedules') }}"
                            style="display: inline-block; margin-top: 16px; color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none; padding: 10px 20px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); transition: all 0.3s ease;"
                            onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='0 0 15px rgba(56, 189, 248, 0.3)'"
                            onmouseout="this.style.background='transparent'; this.style.boxShadow='none'">View Full Schedule</a>
                    </div>
                @endif
            </div>

            <!-- Recent Complaints - Modern Cards -->
            <div
                style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                    <h3
                        style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px;">
                        🔧 Recent Issues & Complaints</h3>
                    <a href="{{ route('farmer.complaint.create') }}"
                        style="color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); transition: all 0.3s ease;"
                        onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='0 0 15px rgba(56, 189, 248, 0.3)'"
                        onmouseout="this.style.background='transparent'; this.style.boxShadow='none'">+ New Issue</a>
                </div>

                @if($complaints->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        @foreach($complaints->take(4) as $complaint)
                            @php
                                $statusColors = [
                                    'pending' => ['bg' => 'rgba(245, 158, 11, 0.15)', 'text' => '#F59E0B', 'border' => 'rgba(245, 158, 11, 0.4)', 'icon' => '⏳'],
                                    'resolved' => ['bg' => 'rgba(34, 197, 94, 0.15)', 'text' => '#10B981', 'border' => 'rgba(34, 197, 94, 0.4)', 'icon' => '✅'],
                                    'urgent' => ['bg' => 'rgba(239, 68, 68, 0.15)', 'text' => '#EF4444', 'border' => 'rgba(239, 68, 68, 0.4)', 'icon' => '🚨'],
                                ];
                                $status = $complaint->status;
                                $colors = $statusColors[$status] ?? $statusColors['pending'];
                            @endphp

                            <div style="background: rgba(255, 255, 255, 0.03); border-radius: 18px; padding: 20px; border: 1px solid {{ $colors['border'] }}; transition: all 0.3s ease; cursor: pointer;"
                                onmouseover="this.style.transform='translateY(-4px)'; this.style.background='rgba(255,255,255,0.06)'; this.style.boxShadow='0 10px 30px {{ str_replace('0.4', '0.2', $colors['border']) }}'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.background='rgba(255,255,255,0.03)'; this.style.boxShadow='none'">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div
                                            style="width: 40px; height: 40px; border-radius: 12px; background: {{ $colors['bg'] }}; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                                            {{ $colors['icon'] }}
                                        </div>
                                        <div>
                                            <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 4px;">
                                                {{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</h4>
                                            <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 500;">ID:
                                                {{ $complaint->id }} • {{ $complaint->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <span
                                        style="display: inline-block; padding: 6px 14px; border-radius: 100px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; background: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; border: 1px solid {{ $colors['border'] }};">
                                        {{ strtoupper($status) }}
                                    </span>
                                </div>
                                <p
                                    style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.5; margin-bottom: 16px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $complaint->description }}</p>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="display: flex; align-items: center; gap: 16px;">
                                        <div style="display: flex; align-items: center; gap: 6px;">
                                            <span style="color: #38BDF8;">📅</span>
                                            <span style="color: #94a3b8; font-size: 0.8rem;">Opened:
                                                {{ $complaint->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if($complaint->status === 'pending')
                                            <div style="display: flex; align-items: center; gap: 6px;">
                                                <span style="color: #F59E0B;">⏱️</span>
                                                <span style="color: #94a3b8; font-size: 0.8rem;">Waiting:
                                                    {{ $complaint->created_at->diffInDays(now()) }} days</span>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('farmer.complaint.show', $complaint->id) }}"
                                        style="color: #38BDF8; font-size: 0.85rem; font-weight: 600; text-decoration: none; padding: 6px 12px; border-radius: 8px; border: 1px solid rgba(56, 189, 248, 0.3); transition: all 0.3s ease;"
                                        onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'"
                                        onmouseout="this.style.background='transparent'">View Details →</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Complaint Stats -->
                    <div
                        style="margin-top: 28px; padding: 20px; background: rgba(56, 189, 248, 0.05); border-radius: 16px; border: 1px solid rgba(56, 189, 248, 0.1);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <p style="color: #cbd5e1; font-size: 0.9rem; font-weight: 600;">Complaint Summary</p>
                                <div style="display: flex; gap: 24px; margin-top: 8px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span
                                            style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #EF4444;"></span>
                                        <span
                                            style="color: #f1f5f9; font-size: 0.9rem; font-weight: 600;">{{ $complaints->where('status', 'urgent')->count() }}
                                            Urgent</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span
                                            style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #F59E0B;"></span>
                                        <span
                                            style="color: #f1f5f9; font-size: 0.9rem; font-weight: 600;">{{ $complaints->where('status', 'pending')->count() }}
                                            Pending</span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span
                                            style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #10B981;"></span>
                                        <span
                                            style="color: #f1f5f9; font-size: 0.9rem; font-weight: 600;">{{ $complaints->where('status', 'resolved')->count() }}
                                            Resolved</span>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('farmer.complaints') }}"
                                style="color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); transition: all 0.3s ease;"
                                onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='0 0 15px rgba(56, 189, 248, 0.3)'"
                                onmouseout="this.style.background='transparent'; this.style.boxShadow='none'">View All History
                                →</a>
                        </div>
                    </div>
                @else
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        <span
                            style="font-size: 3rem; display: block; margin-bottom: 16px; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">✅</span>
                        <h4 style="font-size: 1.2rem; font-weight: 700; color: #cbd5e1; margin-bottom: 8px;">No Issues Reported
                        </h4>
                        <p style="color: #94a3b8; font-size: 0.95rem;">Your system is running smoothly with no complaints.</p>
                        <a href="{{ route('farmer.complaint.create') }}"
                            style="display: inline-block; margin-top: 16px; color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none; padding: 10px 20px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); transition: all 0.3s ease;"
                            onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='0 0 15px rgba(56, 189, 248, 0.3)'"
                            onmouseout="this.style.background='transparent'; this.style.boxShadow='none'">Report an Issue</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Power Usage Analytics Section -->
        <div
            style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); margin-top: 28px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                <h3
                    style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px;">
                    📊 Power Usage Analytics</h3>
                <div style="display: flex; gap: 12px;">
                    <button id="btn-monthly" onclick="toggleAnalytics('monthly')"
                        style="color: #38BDF8; font-size: 0.85rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); background: rgba(56, 189, 248, 0.1); transition: all 0.3s ease; cursor: pointer;">Monthly</button>
                    <button id="btn-weekly" onclick="toggleAnalytics('weekly')"
                        style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.2); background: transparent; transition: all 0.3s ease; cursor: pointer;">Weekly</button>
                    <button id="btn-daily" onclick="toggleAnalytics('daily')"
                        style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.2); background: transparent; transition: all 0.3s ease; cursor: pointer;">Daily</button>
                </div>
            </div>

            <div class="responsive-chart-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 28px;">
                <!-- Chart Area -->
                <div>
                    <!-- Monthly Chart -->
                    <div id="chart-monthly"
                        style="background: rgba(20, 35, 60, 0.3); border-radius: 18px; padding: 24px; border: 1px solid rgba(56, 189, 248, 0.2); height: 300px; position: relative; overflow: hidden; display: flex; align-items: flex-end; gap: 20px;">
                        @php
                            $maxMonthly = $monthlyUsage->max('total') ?: 100;
                        @endphp
                        @foreach($monthlyUsage as $usage)
                            @php
                                $height = ($usage->total / $maxMonthly) * 200;
                                $color = $usage->total > 100 ? '#10B981' : ($usage->total > 50 ? '#38BDF8' : '#F59E0B');
                            @endphp
                            <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
                                <div style="width: 30px; height: {{ $height }}px; background: linear-gradient(to top, {{ $color }}, {{ $color }}99); border-radius: 8px 8px 0 0; position: relative;" title="{{ number_format($usage->total) }} kWh">
                                    <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); color: #f1f5f9; font-size: 0.8rem; font-weight: 700;">{{ number_format($usage->total) }}</div>
                                </div>
                                <div style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-top: 12px;">{{ $usage->billing_month }}</div>
                            </div>
                        @endforeach
                        
                        @if($monthlyUsage->isEmpty())
                            <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: #64748b; font-style: italic;">No monthly records.</div>
                        @endif
                    </div>

                    <!-- Weekly Chart -->
                    <div id="chart-weekly"
                        style="background: rgba(20, 35, 60, 0.3); border-radius: 18px; padding: 24px; border: 1px solid rgba(56, 189, 248, 0.2); height: 300px; position: relative; overflow: hidden; display: none; align-items: flex-end; gap: 20px;">
                        @php
                            $maxWeekly = $weeklyUsage->max('total') ?: 100;
                        @endphp
                        @foreach($weeklyUsage as $usage)
                            @php
                                $height = ($usage->total / $maxWeekly) * 200;
                                $color = $usage->total > 50 ? '#10B981' : ($usage->total > 25 ? '#38BDF8' : '#F59E0B');
                            @endphp
                            <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
                                <div style="width: 30px; height: {{ $height }}px; background: linear-gradient(to top, {{ $color }}, {{ $color }}99); border-radius: 8px 8px 0 0; position: relative;" title="{{ number_format($usage->total) }} kWh">
                                    <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); color: #f1f5f9; font-size: 0.8rem; font-weight: 700;">{{ number_format($usage->total) }}</div>
                                </div>
                                <div style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-top: 12px;">Wk {{ $usage->week_no }}</div>
                            </div>
                        @endforeach

                        @if($weeklyUsage->isEmpty())
                            <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: #64748b; font-style: italic;">No weekly records.</div>
                        @endif
                    </div>

                    <!-- Daily Chart -->
                    <div id="chart-daily"
                        style="background: rgba(20, 35, 60, 0.3); border-radius: 18px; padding: 24px; border: 1px solid rgba(56, 189, 248, 0.2); height: 300px; position: relative; overflow: hidden; display: none; align-items: flex-end; gap: 20px;">
                        @php
                            $maxDaily = $dailyUsage->max('total') ?: 100;
                        @endphp
                        @foreach($dailyUsage as $usage)
                            @php
                                $height = ($usage->total / $maxDaily) * 200;
                                $color = $usage->total > 20 ? '#10B981' : ($usage->total > 10 ? '#38BDF8' : '#F59E0B');
                            @endphp
                            <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
                                <div style="width: 30px; height: {{ $height }}px; background: linear-gradient(to top, {{ $color }}, {{ $color }}99); border-radius: 8px 8px 0 0; position: relative;" title="{{ number_format($usage->total) }} kWh">
                                    <div style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); color: #f1f5f9; font-size: 0.8rem; font-weight: 700;">{{ number_format($usage->total) }}</div>
                                </div>
                                <div style="color: #94a3b8; font-size: 0.75rem; font-weight: 600; margin-top: 12px;">{{ \Carbon\Carbon::parse($usage->date)->format('M d') }}</div>
                            </div>
                        @endforeach

                        @if($dailyUsage->isEmpty())
                            <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: #64748b; font-style: italic;">No daily records.</div>
                        @endif
                    </div>

                    <script>
                        function toggleAnalytics(type) {
                            const views = ['monthly', 'weekly', 'daily'];
                            views.forEach(v => {
                                document.getElementById('chart-' + v).style.display = (v === type) ? 'flex' : 'none';
                                const btn = document.getElementById('btn-' + v);
                                if (v === type) {
                                    btn.style.color = '#38BDF8';
                                    btn.style.background = 'rgba(56, 189, 248, 0.1)';
                                    btn.style.borderColor = 'rgba(56, 189, 248, 0.3)';
                                } else {
                                    btn.style.color = '#94a3b8';
                                    btn.style.background = 'transparent';
                                    btn.style.borderColor = 'rgba(56, 189, 248, 0.2)';
                                }
                            });
                        }
                    </script>

                    <!-- Chart Legend -->
                    <div style="display: flex; justify-content: center; gap: 24px; margin-top: 20px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="display: inline-block; width: 12px; height: 12px; border-radius: 2px; background: #10B981;"></span>
                            <span style="color: #cbd5e1; font-size: 0.85rem;">High Efficient</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="display: inline-block; width: 12px; height: 12px; border-radius: 2px; background: #38BDF8;"></span>
                            <span style="color: #cbd5e1; font-size: 0.85rem;">Optimized</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="display: inline-block; width: 12px; height: 12px; border-radius: 2px; background: #F59E0B;"></span>
                            <span style="color: #cbd5e1; font-size: 0.85rem;">Load Spike</span>
                        </div>
                    </div>
                </div>

                <!-- Analytics Stats -->
                <div>
                    <div
                        style="background: rgba(20, 35, 60, 0.3); border-radius: 18px; padding: 24px; border: 1px solid rgba(56, 189, 248, 0.2); margin-bottom: 20px;">
                        <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 16px;">📈 Usage
                            Insights</h4>
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            <div>
                                <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 4px;">Current Month</p>
                                <p style="font-size: 1.5rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ number_format($currentMonthUsage) }} kWh</p>
                            </div>
                            <div>
                                <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 4px;">Compared to Last Month</p>
                                <p style="font-size: 1.1rem; font-weight: 700; color: {{ $usageChange > 0 ? '#F59E0B' : '#10B981' }};">
                                    {{ $usageChange > 0 ? '↑' : '↓' }} {{ abs(round($usageChange)) }}% {{ $usageChange > 0 ? 'higher' : 'lower' }}
                                </p>
                            </div>
                            <div>
                                <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 4px;">Estimated Bill</p>
                                <p style="font-size: 1.1rem; font-weight: 700; color: #F59E0B;">₹{{ number_format($currentMonthUsage * 7) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- AI Insights Card -->
                    <div
                        style="background: linear-gradient(135deg, rgba(56, 189, 248, 0.1) 0%, rgba(16, 185, 129, 0.1) 100%); border-radius: 18px; padding: 24px; border: 1px solid rgba(56, 189, 248, 0.3);">
                        <h4
                            style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            🤖 AI Insights</h4>
                        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.5; margin-bottom: 16px;">{{ $aiInsight }}</p>
                        <button
                            style="color: #38BDF8; font-size: 0.85rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); background: rgba(56, 189, 248, 0.1); transition: all 0.3s ease; width: 100%;"
                            onmouseover="this.style.background='rgba(56, 189, 248, 0.2)'; this.style.boxShadow='0 0 15px rgba(56, 189, 248, 0.3)'"
                            onmouseout="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='none'">View
                            Optimization Tips</button>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="responsive-stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 28px;">
                <div
                    style="background: rgba(255, 255, 255, 0.03); border-radius: 16px; padding: 16px; border: 1px solid rgba(56, 189, 248, 0.1);">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 8px;">Peak Usage</p>
                    <p style="font-size: 1.25rem; font-weight: 800; color: #f1f5f9;">{{ number_format($peakUsageValue) }} kWh</p>
                </div>
                <div
                    style="background: rgba(255, 255, 255, 0.03); border-radius: 16px; padding: 16px; border: 1px solid rgba(56, 189, 248, 0.1);">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 8px;">Mean Usage</p>
                    <p style="font-size: 1.25rem; font-weight: 800; color: #f1f5f9;">{{ number_format($avgUsageValue) }} kWh</p>
                </div>
                <div
                    style="background: rgba(255, 255, 255, 0.03); border-radius: 16px; padding: 16px; border: 1px solid rgba(56, 189, 248, 0.1);">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 8px;">Daily Average</p>
                    <p style="font-size: 1.25rem; font-weight: 800; color: #f1f5f9;">{{ number_format($totalUnits / 30, 1) }} kWh</p>
                </div>
                <div
                    style="background: rgba(255, 255, 255, 0.03); border-radius: 16px; padding: 16px; border: 1px solid rgba(56, 189, 248, 0.1);">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 8px;">Carbon Offset</p>
                    <p style="font-size: 1.25rem; font-weight: 800; color: #10B981;">{{ number_format($carbonSaved, 1) }} kg</p>
                </div>
            </div>
        </div>
    </div>
@endsection