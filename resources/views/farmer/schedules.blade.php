@extends('layouts.main')

@section('main-content')
    <style>
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(56, 189, 248, 0.4)); }
            50% { filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.7)); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .glass-container {
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(56, 189, 248, 0.25); 
            border-radius: 24px; 
            padding: 32px; 
            box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);
        }

        .schedule-table th {
            padding: 16px; 
            text-align: left; 
            color: #94a3b8; 
            font-size: 0.85rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            letter-spacing: 0.5px;
        }

        .schedule-table td {
            padding: 20px 16px; 
            color: #f1f5f9; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.05);
        }

        .schedule-row {
            transition: all 0.3s ease;
        }
        .schedule-row:hover {
            background: rgba(56, 189, 248, 0.05);
            transform: scale(1.002);
        }

        .allocation-badge {
            background: rgba(16, 185, 129, 0.1); 
            color: #10B981; 
            padding: 6px 14px; 
            border-radius: 100px; 
            font-size: 0.75rem; 
            font-weight: 800; 
            border: 1px solid rgba(16, 185, 129, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 32px;">
        <!-- Header -->
            <div style="display: flex; flex-direction: column; md:flex-row justify-content: space-between; align-items: flex-start; md:items-center gap: 20px;">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <span class="pulse-glow" style="font-size: 2.5rem;">⚡</span>
                    <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                        Electricity <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Schedules</span>
                    </h2>
                </div>

                @if(isset($connections) && $connections->count() > 1)
                    <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(56, 189, 248, 0.3); padding: 8px 20px; border-radius: 16px; display: flex; align-items: center; gap: 12px; backdrop-filter: blur(10px);">
                        <span style="color: #94a3b8; font-size: 0.8rem; font-weight: 700;">CONNECTION:</span>
                        <select onchange="window.location.href='?connection_id='+this.value" 
                                style="background: transparent; color: #38BDF8; border: none; font-weight: 800; font-size: 0.9rem; cursor: pointer; outline: none;">
                            @foreach($connections as $conn)
                                <option value="{{ $conn->id }}" {{ ($farmer->id ?? null) == $conn->id ? 'selected' : '' }} style="background: #0f172a; color: #f1f5f9;">
                                    {{ $conn->connection_no ?? 'Unknown' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <p style="color: #94a3b8; font-size: 1.1rem; margin-left: 56px;">Monitor assigned agricultural electricity timings for: <span style="color: #38BDF8;">{{ $farmer->connection_no ?? '---' }} ({{ $farmer->village ?? '---' }})</span></p>

        <!-- Main Schedule Container -->
        <div class="glass-container">
            <div style="overflow-x: auto;">
                <table class="schedule-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th>Target Connection</th>
                            <th>Active Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Allocation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr class="schedule-row">
                                <td style="font-weight: 700; color: #38BDF8;">
                                    <div style="display: flex; flex-direction: column; gap: 4px;">
                                        <span>{{ $schedule->zone ?? 'Unknown' }}</span>
                                        @if($schedule->farmer_id)
                                            <span style="font-size: 0.7rem; color: #10B981; font-weight: 500;">Connection: {{ $schedule->farmer?->connection_no ?? 'N/A' }}</span>
                                        @else
                                            <span style="font-size: 0.7rem; color: #64748b; font-weight: 500;">Universal Grid Zone</span>
                                        @endif
                                    </div>
                                </td>
                                <td style="color: #f1f5f9;">{{ $schedule->day_of_week ?? 'N/A' }}</td>
                                <td style="color: #f1f5f9; font-weight: 600;">{{ $schedule->start_time ?? '--:--' }}</td>
                                <td style="color: #f1f5f9; font-weight: 600;">{{ $schedule->end_time ?? '--:--' }}</td>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 8px;">
                                        @php
                                            $statusVal = $schedule->dynamic_status ?? 'inactive';
                                            $statusColor = match($statusVal) {
                                                'active' => '#10B981',
                                                'upcoming' => '#F59E0B',
                                                'maintenance' => '#EF4444',
                                                default => '#64748b'
                                            };
                                            $statusLabel = match($statusVal) {
                                                'active' => '⚡ Active',
                                                'upcoming' => '⏳ Upcoming',
                                                'maintenance' => '🔧 Maintenance',
                                                default => '⏸️ Inactive'
                                            };
                                        @endphp
                                        <div class="allocation-badge" style="background: {{ $statusColor }}1A; color: {{ $statusColor }}; border-color: {{ $statusColor }}4D; margin-bottom: 4px;">
                                            <span style="width: 6px; height: 6px; background: {{ $statusColor }}; border-radius: 50%;"></span>
                                            {{ $statusLabel }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #94a3b8; font-weight: 600; padding-left: 4px;">
                                            💧 {{ $schedule->allocation_percentage ?? 0 }}% Flow
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 0;">
                                    <div style="padding: 80px 20px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 20px;">
                                        <div class="float-animation" style="width: 100px; h: 100px; background: rgba(56, 189, 248, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(56, 189, 248, 0.1);">
                                            <span style="font-size: 3rem; filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.4));">📋</span>
                                        </div>
                                        <div>
                                            <h3 style="color: #f1f5f9; font-size: 1.5rem; font-weight: 800; margin-bottom: 8px;">No active schedules available</h3>
                                            <p style="color: #64748b; font-size: 1rem; max-width: 400px; margin: 0 auto;">Your agricultural electricity timings will appear here once assigned by the regional grid controller.</p>
                                        </div>
                                        <div style="margin-top: 10px; padding: 8px 20px; background: rgba(255,255,255,0.03); border-radius: 100px; border: 1px solid rgba(255,255,255,0.05); color: #475569; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                                            Awaiting System Update
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Information -->
        <div style="padding: 24px; background: rgba(56, 189, 248, 0.03); border: 1px dashed rgba(56, 189, 248, 0.15); border-radius: 20px; display: flex; align-items: center; gap: 16px;">
            <div style="font-size: 1.5rem;">ℹ️</div>
            <p style="color: #94a3b8; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                <strong style="color: #f1f5f9;">Grid Maintenance Notice:</strong> Schedules are updated in real-time. Please ensure your agricultural equipment is synchronized with the assigned timings to optimize energy consumption and grid stability.
            </p>
        </div>
    </div>
@endsection