@extends('layouts.main')

@section('main-content')
    <div style="display: flex; flex-direction: column; gap: 28px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 2rem; font-weight: 800; color: #f1f5f9;">⏰ Electricity <span style="background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Schedules</span></h2>
        </div>

        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Schedule Name</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Start Time</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">End Time</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Status</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr style="transition: background 0.3s ease;" onmouseover="this.style.background='rgba(56, 189, 248, 0.05)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 16px; color: #f1f5f9; font-weight: 600; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $schedule->schedule_name ?? 'Untitled' }}</td>
                                <td style="padding: 16px; color: #38BDF8; font-weight: 700; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $schedule->start_time }}</td>
                                <td style="padding: 16px; color: #38BDF8; font-weight: 700; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $schedule->end_time }}</td>
                                <td style="padding: 16px; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">
                                    @php
                                        $statusColor = $schedule->status === 'active' ? '#10B981' : '#94a3b8';
                                        $statusBg = $schedule->status === 'active' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(148, 163, 184, 0.1)';
                                    @endphp
                                    <span style="background: {{ $statusBg }}; color: {{ $statusColor }}; padding: 6px 12px; border-radius: 100px; font-size: 0.75rem; font-weight: 700; border: 1px solid {{ $statusColor }}40; text-transform: uppercase; letter-spacing: 0.5px;">
                                        {{ ucfirst($schedule->status ?? 'active') }}
                                    </span>
                                </td>
                                <td style="padding: 16px; color: #64748b; font-size: 0.85rem; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $schedule->created_at ? $schedule->created_at->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 32px; text-align: center; color: #94a3b8; font-style: italic;">No schedules found for monitoring.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div style="margin-top: 24px; padding: 16px; border-top: 1px solid rgba(56, 189, 248, 0.1);">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
@endsection