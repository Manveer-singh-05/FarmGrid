@extends('layouts.main')

@section('main-content')
    <div style="display: flex; flex-direction: column; gap: 28px;">
        <!-- Hero Section -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 32px; padding: 40px; box-shadow: 0 0 30px rgba(34, 197, 94, 0.15), 0 25px 80px rgba(37, 99, 235, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1); position: relative; overflow: hidden;">
            <div style="position: absolute; top: -40%; right: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%); border-radius: 50%; filter: blur(60px); pointer-events: none;"></div>
            <div style="position: relative; z-index: 1;">
                <h2 style="font-size: 2.25rem; font-weight: 800; margin-bottom: 8px;">Welcome back, <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ explode(' ', Auth::user()->name)[0] }} 👋</span></h2>
                <p style="color: #cbd5e1; font-size: 1.1rem; margin-bottom: 24px;">Manage your agricultural electricity efficiently with FarmGrid.</p>
                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <div style="background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); padding: 8px 16px; border-radius: 100px; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #38BDF8;">●</span>
                        <span style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9;">System Live</span>
                    </div>
                    <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); padding: 8px 16px; border-radius: 100px; display: flex; align-items: center; gap: 8px;">
                        <span style="color: #10B981;">🛡️</span>
                        <span style="font-size: 0.9rem; font-weight: 600; color: #f1f5f9;">Secure Distribution</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(34, 197, 94, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(34, 197, 94, 0.5)'; this.style.boxShadow='0 0 35px rgba(34, 197, 94, 0.25)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(56, 189, 248, 0.25)'; this.style.boxShadow='0 0 20px rgba(34, 197, 94, 0.1)'">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Connection Status</h3>
                        @if($farmer)
                            <p style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">{{ ucfirst($farmer->status) }}</p>
                            <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">ID: {{ $farmer->connection_no }}</p>
                        @else
                            <a href="{{ route('farmer.apply') }}" style="color: #38BDF8; font-weight: 600; text-decoration: none; font-size: 1.1rem; display: block; margin-top: 8px;">Apply Now →</a>
                        @endif
                    </div>
                    <div style="font-size: 2.25rem; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">⚡</div>
                </div>
            </div>

            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(245, 158, 11, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(245, 158, 11, 0.5)'; this.style.boxShadow='0 0 35px rgba(245, 158, 11, 0.25)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(56, 189, 248, 0.25)'; this.style.boxShadow='0 0 20px rgba(245, 158, 11, 0.1)'">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Pending Issues</h3>
                        <p style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #F59E0B 0%, #EF4444 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">{{ $complaints->where('status', 'pending')->count() }}</p>
                        <a href="{{ route('farmer.complaints') }}" style="color: #F59E0B; font-size: 0.85rem; font-weight: 600; text-decoration: none;">View Detail →</a>
                    </div>
                    <div style="font-size: 2.25rem; filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.3));">🔧</div>
                </div>
            </div>

            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(56, 189, 248, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-8px)'; this.style.borderColor='rgba(56, 189, 248, 0.5)'; this.style.boxShadow='0 0 35px rgba(56, 189, 248, 0.25)'" onmouseout="this.style.transform='translateY(0)'; this.style.borderColor='rgba(56, 189, 248, 0.25)'; this.style.boxShadow='0 0 20px rgba(56, 189, 248, 0.1)'">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Monthly Usage</h3>
                        @if($powerUsage)
                            <p style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #3B82F6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 4px;">{{ $powerUsage->units_used }} <span style="font-size: 1.25rem;">kWh</span></p>
                            <p style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Bill: ₹{{ $powerUsage->bill_amount }}</p>
                        @else
                            <p style="color: #64748b; font-size: 1.1rem; font-weight: 600; margin-top: 8px;">No Data</p>
                        @endif
                    </div>
                    <div style="font-size: 2.25rem; filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.3));">📈</div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 28px;">
            <!-- Electricity Schedule -->
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px;">📅 Today's Schedule</h3>
                    <a href="{{ route('farmer.schedules') }}" style="color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none;">View All</a>
                </div>
                
                @if($schedules->count() > 0)
                    <div style="overflow-hidden; border-radius: 16px; border: 1px solid rgba(56, 189, 248, 0.1);">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="background: rgba(56, 189, 248, 0.1);">
                                    <th style="padding: 16px; color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Zone</th>
                                    <th style="padding: 16px; color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Timings</th>
                                    <th style="padding: 16px; color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                    <tr style="border-bottom: 1px solid rgba(56, 189, 248, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.03)'" onmouseout="this.style.background='transparent'">
                                        <td style="padding: 16px; color: #f1f5f9; font-weight: 600;">{{ $schedule->zone }}</td>
                                        <td style="padding: 16px; color: #cbd5e1;">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                                        <td style="padding: 16px;">
                                            <span style="display: inline-block; padding: 4px 12px; border-radius: 100px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; {{ $schedule->status === 'active' ? 'background: rgba(34, 197, 94, 0.15); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.3);' : 'background: rgba(239, 68, 68, 0.15); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3);' }}">
                                                {{ $schedule->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        <span style="font-size: 2rem; display: block; margin-bottom: 12px;">📭</span>
                        No active schedules for today.
                    </div>
                @endif
            </div>

            <!-- Recent Complaints -->
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; display: flex; align-items: center; gap: 10px;">🔧 Recent Issues</h3>
                </div>
                
                @if($complaints->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        @foreach($complaints->take(4) as $complaint)
                            <div style="background: rgba(255, 255, 255, 0.03); border-radius: 16px; padding: 16px; border: 1px solid rgba(56, 189, 248, 0.05); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.06)'; this.style.borderColor='rgba(56, 189, 248, 0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.03)'; this.style.borderColor='rgba(56, 189, 248, 0.05)'">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                    <span style="font-size: 0.95rem; font-weight: 700; color: #f1f5f9;">{{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</span>
                                    <span style="font-size: 0.75rem; font-weight: 700; padding: 2px 8px; border-radius: 6px; {{ $complaint->status === 'resolved' ? 'background: rgba(34, 197, 94, 0.2); color: #4ade80;' : 'background: rgba(245, 158, 11, 0.2); color: #fbbf24;' }}">
                                        {{ strtoupper($complaint->status) }}
                                    </span>
                                </div>
                                <p style="color: #94a3b8; font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">{{ $complaint->description }}</p>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('farmer.complaints') }}" style="display: block; text-align: center; margin-top: 24px; color: #38BDF8; font-size: 0.9rem; font-weight: 600; text-decoration: none;">View All History</a>
                @else
                    <div style="text-align: center; padding: 40px; color: #64748b;">
                        <span style="font-size: 2rem; display: block; margin-bottom: 12px;">✅</span>
                        Your system is issue-free.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection