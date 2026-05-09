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
            font-size: 0.8rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            letter-spacing: 0.5px;
        }

        .schedule-table td {
            padding: 20px 16px; 
            color: #f1f5f9; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.05);
            font-size: 0.9rem;
        }

        .schedule-row {
            transition: all 0.3s ease;
        }
        .schedule-row:hover {
            background: rgba(56, 189, 248, 0.05);
            transform: scale(1.002);
        }

        /* Status Badge System */
        .status-badge {
            padding: 6px 12px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-width: 1px;
            border-style: solid;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.1);
        }

        .status-maintenance {
            background: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
            border-color: rgba(245, 158, 11, 0.3);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.1);
        }

        .status-disabled {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.1);
        }

        .action-link {
            color: #94a3b8;
            font-weight: 700;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .action-link:hover {
            color: #38BDF8;
            transform: translateX(2px);
        }
        .action-delete:hover {
            color: #EF4444;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 32px; padding: 10px 0;">
        <!-- Header Section -->
        <div style="display: flex; flex-direction: column; sm:flex-row justify-content: space-between; align-items: flex-start; sm:items-center gap: 6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div class="pulse-glow" style="width: 64px; height: 64px; background: rgba(56, 189, 248, 0.1); border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    ⏰
                </div>
                <div>
                    <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                        Electricity <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Schedules</span>
                    </h2>
                    <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 4px;">Manage zone-wise smart electricity distribution schedules.</p>
                </div>
            </div>

            <a href="{{ route('admin.schedule.create') }}" 
               class="btn-shine"
               style="background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); color: white; padding: 16px 32px; border-radius: 16px; font-weight: 800; text-decoration: none; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 20px rgba(56, 189, 248, 0.2); transition: all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-4px) scale(1.02)'; this.style.boxShadow='0 15px 30px rgba(56, 189, 248, 0.4)'"
               onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 20px rgba(56, 189, 248, 0.2)'">
                <span style="font-size: 1.2rem;">➕</span> Create Schedule
            </a>
        </div>

        <!-- System Alerts -->
        @if (session('success'))
            <div style="padding: 16px 24px; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 16px; color: #10B981; font-weight: 600; display: flex; align-items: center; gap: 12px; backdrop-filter: blur(10px);">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <!-- Main Schedule Container -->
        <div class="glass-container">
            <div style="overflow-x: auto;">
                <table class="schedule-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th>Grid Zone</th>
                            <th>Active Duration</th>
                            <th>Current Status</th>
                            <th>System Description</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr class="schedule-row">
                                <td style="font-weight: 800; color: #38BDF8;">{{ $schedule->zone }}</td>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 2px;">
                                        <span style="font-weight: 700; color: #f1f5f9;">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }} — {{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</span>
                                        <span style="font-size: 0.75rem; color: #64748b; font-weight: 600;">Daily Recurring Cycle</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = 'status-active';
                                        if($schedule->status === 'maintenance') $statusClass = 'status-maintenance';
                                        if($schedule->status === 'disabled') $statusClass = 'status-disabled';
                                    @endphp
                                    <div class="status-badge {{ $statusClass }}">
                                        <span style="width: 6px; height: 6px; background: currentColor; border-radius: 50%; box-shadow: 0 0 10px currentColor;"></span>
                                        {{ ucfirst($schedule->status) }}
                                    </div>
                                </td>
                                <td style="color: #94a3b8; font-size: 0.85rem; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $schedule->description ?? 'No detailed parameters specified' }}
                                </td>
                                <td>
                                    <div style="display: flex; items-center; gap: 16px;">
                                        <a href="{{ route('admin.schedule.edit', $schedule->id) }}" class="action-link">
                                            <span>✏️</span> Edit
                                        </a>
                                        <form action="{{ route('admin.schedule.delete', $schedule->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-link action-delete" style="background: none; border: none; padding: 0; cursor: pointer; font-family: inherit;" onclick="return confirm('Permanently remove this distribution schedule?')">
                                                <span>🗑️</span> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 0;">
                                    <div style="padding: 100px 20px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 24px;">
                                        <div class="float-animation" style="width: 120px; height: 120px; background: rgba(56, 189, 248, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(56, 189, 248, 0.1);">
                                            <span style="font-size: 4rem; filter: drop-shadow(0 0 20px rgba(56, 189, 248, 0.4));">⏰</span>
                                        </div>
                                        <div>
                                            <h3 style="color: #f1f5f9; font-size: 1.8rem; font-weight: 800; margin-bottom: 12px;">No active schedules</h3>
                                            <p style="color: #64748b; font-size: 1.1rem; max-width: 450px; margin: 0 auto; line-height: 1.6;">
                                                The electricity distribution network is currently running on default parameters. Create your first smart-grid schedule to begin automated load management.
                                            </p>
                                        </div>
                                        <a href="{{ route('admin.schedule.create') }}" 
                                           style="margin-top: 10px; color: #38BDF8; font-weight: 700; text-decoration: none; font-size: 0.9rem; border-bottom: 2px solid rgba(56, 189, 248, 0.3); padding-bottom: 4px; transition: all 0.3s ease;"
                                           onmouseover="this.style.borderColor='#38BDF8'; this.style.letterSpacing='1px'"
                                           onmouseout="this.style.borderColor='rgba(56, 189, 248, 0.3)'; this.style.letterSpacing='0'">
                                            Initialize first grid schedule
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            @if ($schedules->hasPages())
                <div style="margin-top: 32px; padding: 24px; border-top: 1px solid rgba(56, 189, 248, 0.1); display: flex; justify-content: center;">
                    {{ $schedules->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
