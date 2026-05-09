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

        .farmer-table th {
            padding: 16px; 
            text-align: left; 
            color: #94a3b8; 
            font-size: 0.8rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            letter-spacing: 0.5px;
        }

        .farmer-table td {
            padding: 20px 16px; 
            color: #f1f5f9; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.05);
            font-size: 0.9rem;
        }

        .farmer-row {
            transition: all 0.3s ease;
        }
        .farmer-row:hover {
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

        .status-approved {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.1);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
            border-color: rgba(245, 158, 11, 0.3);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.1);
        }

        .status-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.1);
        }

        /* Compact Action Buttons */
        .btn-action {
            padding: 6px 12px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.75rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .btn-approve {
            background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
        }
        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(56, 189, 248, 0.4);
        }

        .btn-reject {
            background: linear-gradient(135deg, #EF4444 0%, #F43F5E 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }
        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.4);
        }

        .alert-card {
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid;
            font-weight: 600;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 32px; padding: 10px 0;">
        <!-- Header Section -->
        <div style="display: flex; flex-direction: column; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="pulse-glow" style="font-size: 2.5rem;">👨‍🌾</span>
                <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                    Farmer <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Applications</span>
                </h2>
            </div>
            <p style="color: #94a3b8; font-size: 1.1rem; margin-left: 56px;">Review and manage agricultural electricity connection requests.</p>
        </div>

        <!-- System Alerts -->
        @if (session('success'))
            <div class="alert-card" style="background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3); color: #10B981;">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert-card" style="background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.3); color: #EF4444;">
                <span>❌</span> {{ session('error') }}
            </div>
        @endif

        <!-- Farmer Table Container -->
        <div class="glass-container">
            <div style="overflow-x: auto;">
                <table class="farmer-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th># ID</th>
                            <th>Farmer Details</th>
                            <th>Village</th>
                            <th>Land Area</th>
                            <th>Connection No.</th>
                            <th>Status</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($farmers as $farmer)
                            <tr class="farmer-row">
                                <td style="color: #64748b; font-weight: 700;">#{{ $farmer->id }}</td>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 2px;">
                                        <span style="font-weight: 800; color: #f1f5f9;">{{ $farmer->user->name ?? 'N/A' }}</span>
                                        <span style="font-size: 0.75rem; color: #94a3b8;">{{ $farmer->user->email ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td style="color: #cbd5e1;">{{ $farmer->village }}</td>
                                <td style="font-weight: 600; color: #38BDF8;">{{ $farmer->land_area }} acres</td>
                                <td style="font-family: monospace; color: #cbd5e1; letter-spacing: 1px;">{{ $farmer->connection_no }}</td>
                                <td>
                                    @php
                                        $statusClass = 'status-pending';
                                        if($farmer->status === 'approved') $statusClass = 'status-approved';
                                        if($farmer->status === 'rejected') $statusClass = 'status-rejected';
                                    @endphp
                                    <div class="status-badge {{ $statusClass }}">
                                        <span style="width: 6px; height: 6px; background: currentColor; border-radius: 50%; box-shadow: 0 0 10px currentColor;"></span>
                                        {{ ucfirst($farmer->status) }}
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; items-center; gap: 10px;">
                                        @if ($farmer->status === 'pending')
                                            <form action="{{ route('admin.farmer.approve', $farmer->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-action btn-approve" onclick="return confirm('Confirm profile approval?')">
                                                    <span>✓</span> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.farmer.reject', $farmer->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-action btn-reject" onclick="return confirm('Confirm profile rejection?')">
                                                    <span>✗</span> Reject
                                                </button>
                                            </form>
                                        @else
                                            <span style="font-size: 0.7rem; color: #475569; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Processed</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 0;">
                                    <div style="padding: 100px 20px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 24px;">
                                        <div class="float-animation" style="width: 120px; height: 120px; background: rgba(56, 189, 248, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(56, 189, 248, 0.1);">
                                            <span style="font-size: 4rem; filter: drop-shadow(0 0 20px rgba(56, 189, 248, 0.4));">👨‍🌾</span>
                                        </div>
                                        <div>
                                            <h3 style="color: #f1f5f9; font-size: 1.8rem; font-weight: 800; margin-bottom: 12px;">No applications found</h3>
                                            <p style="color: #64748b; font-size: 1.1rem; max-width: 450px; margin: 0 auto; line-height: 1.6;">
                                                All agricultural electricity connection requests have been processed. New farmer registrations will appear here for review.
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            @if ($farmers->hasPages())
                <div style="margin-top: 32px; padding: 24px; border-top: 1px solid rgba(56, 189, 248, 0.1); display: flex; justify-content: center;">
                    {{ $farmers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
