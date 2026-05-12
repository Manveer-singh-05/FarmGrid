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
                <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 12px;">Admin Overview, <span
                        style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ explode(' ', Auth::user()->name)[0] }}
                        👋</span></h2>
                <p style="color: #cbd5e1; font-size: 1.2rem; margin-bottom: 32px; max-width: 800px;">Monitor and manage the entire FarmGrid smart distribution network efficiently.</p>

                <!-- Status Badges -->
                <div style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
                    <div style="background: rgba(56, 189, 248, 0.15); border: 1px solid rgba(56, 189, 248, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(56, 189, 248, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <span style="color: #38BDF8; font-size: 1.2rem;">👨‍🌾</span>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">Total Users</p>
                            <p style="font-size: 1rem; font-weight: 700; color: #38BDF8; margin: 0;">
                                {{ $totalFarmers }} Farmers</p>
                        </div>
                    </div>

                    <div style="background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(34, 197, 94, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <span style="color: #10B981; font-size: 1.2rem;">⚡</span>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">System Status</p>
                            <p style="font-size: 1rem; font-weight: 700; color: #10B981; margin: 0;">
                                Operational</p>
                        </div>
                    </div>

                    <div style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(245, 158, 11, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <span style="color: #F59E0B; font-size: 1.2rem;">📋</span>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">Pending Apps</p>
                            <p style="font-size: 1rem; font-weight: 700; color: #F59E0B; margin: 0;">
                                {{ number_format($pendingApplications ?? 0) }} Awaiting</p>
                        </div>
                    </div>

                    <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); padding: 12px 20px; border-radius: 16px; display: flex; align-items: center; gap: 10px; transition: all 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(239, 68, 68, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <span style="color: #EF4444; font-size: 1.2rem;">⚠️</span>
                        <div>
                            <p style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9; margin: 0;">Open Issues</p>
                            <p style="font-size: 1rem; font-weight: 700; color: #EF4444; margin: 0;">
                                {{ number_format($pendingComplaints ?? 0) }} Pending</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #f1f5f9; margin-top: 8px;">📊 Dashboard Overview</h2>
        <div class="responsive-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(34, 197, 94, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Total Farmers</h3>
                        <p style="font-size: 2.5rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">{{ $totalFarmers }}</p>
                        <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Registered accounts</p>
                    </div>
                    <div class="float-animation" style="font-size: 2.5rem; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">👨‍🌾</div>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(245, 158, 11, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Pending Applications</h3>
                        <p style="font-size: 2.5rem; font-weight: 800; background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">{{ $pendingApplications }}</p>
                        <a href="{{ route('admin.farmers') }}" style="color: #F59E0B; font-size: 0.85rem; font-weight: 600; text-decoration: none;">Review →</a>
                    </div>
                    <div class="float-animation" style="font-size: 2.5rem; filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.3));">📋</div>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(239, 68, 68, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Total Complaints</h3>
                        <p style="font-size: 2.5rem; font-weight: 800; background: linear-gradient(135deg, #EC4899 0%, #EF4444 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">{{ $totalComplaints }}</p>
                        <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">All time issues</p>
                    </div>
                    <div class="float-animation" style="font-size: 2.5rem; filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.3));">🔧</div>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(245, 158, 11, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Pending Complaints</h3>
                        <p style="font-size: 2.5rem; font-weight: 800; background: linear-gradient(135deg, #F59E0B 0%, #EF4444 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">{{ $pendingComplaints }}</p>
                        <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Requires attention</p>
                    </div>
                    <div class="float-animation" style="font-size: 2.5rem; filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.3));">⚠️</div>
                </div>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); margin-top: 8px;">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px; margin-bottom: 24px;">🚀 Quick Actions</h3>
            <div class="responsive-quick-actions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <a href="{{ route('admin.schedule.create') }}"
                   class="hover-lift smooth-transition" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 18px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                   <span class="float-animation" style="font-size: 2.5rem; margin-bottom: 12px;">➕</span>
                    <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px;">Create Schedule</h4>
                    <p style="color: #94a3b8; font-size: 0.85rem; text-align: center;">Set up new electricity zones</p>
                </a>
                
                <a href="{{ route('admin.farmers') }}"
                   class="hover-lift smooth-transition" style="background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 18px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                   <span class="float-animation" style="font-size: 2.5rem; margin-bottom: 12px;">👁️</span>
                    <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px;">Review Applications</h4>
                    <p style="color: #94a3b8; font-size: 0.85rem; text-align: center;">Approve new farmer requests</p>
                </a>
                
                <a href="{{ route('admin.complaints') }}"
                   class="hover-lift smooth-transition" style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 18px; padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                   <span class="float-animation" style="font-size: 2.5rem; margin-bottom: 12px;">🔧</span>
                    <h4 style="font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px;">Resolve Complaints</h4>
                    <p style="color: #94a3b8; font-size: 0.85rem; text-align: center;">Manage reported network issues</p>
                </a>
            </div>
        </div>

        <!-- Active Schedules Table -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); margin-top: 8px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px;">📅 Active Electricity Schedules</h3>
                <a href="{{ route('admin.schedules') }}"
                   style="color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none; padding: 8px 16px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); transition: all 0.3s ease;"
                   onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'; this.style.boxShadow='0 0 15px rgba(56, 189, 248, 0.3)'"
                   onmouseout="this.style.background='transparent'; this.style.boxShadow='none'">View All</a>
            </div>

            @if($schedules->count() > 0)
                <div style="overflow-x: auto; background: rgba(0, 0, 0, 0.1); border-radius: 16px; padding: 1px;">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                        <thead>
                            <tr style="background: rgba(255, 255, 255, 0.02);">
                                <th style="padding: 16px; text-align: left; color: #94a3b8; font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); border-top-left-radius: 16px;">Zone</th>
                                <th style="padding: 16px; text-align: left; color: #94a3b8; font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">Time Slot</th>
                                <th style="padding: 16px; text-align: left; color: #94a3b8; font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">Status</th>
                                <th style="padding: 16px; text-align: left; color: #94a3b8; font-weight: 600; font-size: 0.9rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); border-top-right-radius: 16px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules->take(10) as $schedule)
                                <tr style="transition: background 0.2s;" onmouseover="this.style.background='rgba(255, 255, 255, 0.03)'" onmouseout="this.style.background='transparent'">
                                    <td style="padding: 16px; color: #f1f5f9; font-weight: 500; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">{{ $schedule->zone ?? 'Unknown' }}</td>
                                    <td style="padding: 16px; color: #cbd5e1; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">{{ $schedule->start_time ?? '--' }} - {{ $schedule->end_time ?? '--' }}</td>
                                    <td style="padding: 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                                        <span style="display: inline-block; padding: 4px 12px; border-radius: 100px; font-size: 0.8rem; font-weight: 600; {{ ($schedule->status ?? '') === 'active' ? 'background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3);' : 'background: rgba(148, 163, 184, 0.2); color: #cbd5e1; border: 1px solid rgba(148, 163, 184, 0.3);' }}">
                                            {{ ucfirst($schedule->status ?? 'Inactive') }}
                                        </span>
                                    </td>
                                    <td style="padding: 16px; border-bottom: 1px solid rgba(255, 255, 255, 0.05);">
                                        <a href="#" style="color: #38BDF8; text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='#7dd3fc'" onmouseout="this.style.color='#38BDF8'">Edit →</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 40px; color: #64748b;">
                    <span style="font-size: 3rem; display: block; margin-bottom: 16px; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">📅</span>
                    <h4 style="font-size: 1.2rem; font-weight: 700; color: #cbd5e1; margin-bottom: 8px;">No schedules created yet</h4>
                    <p style="color: #94a3b8; font-size: 0.95rem;">Click the Quick Action above to create a new electricity schedule.</p>
                </div>
            @endif
        </div>
    </div>
@endsection