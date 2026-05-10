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

        .usage-table th {
            padding: 16px; 
            text-align: left; 
            color: #94a3b8; 
            font-size: 0.8rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            letter-spacing: 0.5px;
        }

        .usage-table td {
            padding: 20px 16px; 
            color: #f1f5f9; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.05);
            font-size: 0.9rem;
        }

        .usage-row {
            transition: all 0.3s ease;
        }
        .usage-row:hover {
            background: rgba(56, 189, 248, 0.05);
            transform: scale(1.002);
        }

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
            cursor: pointer;
        }

        .btn-usage {
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2);
        }
        .btn-usage:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(56, 189, 248, 0.4);
        }

        /* Modal styling */
        .modal {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(56, 189, 248, 0.3);
            border-radius: 24px;
            width: 100%;
            max-width: 500px;
            padding: 32px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            color: white;
            margin-top: 8px;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #38BDF8;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.2);
        }
        .form-label {
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 20px;
            display: block;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 32px; padding: 10px 0;">
        <div style="display: flex; flex-direction: column; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="pulse-glow" style="font-size: 2.5rem;">⚡</span>
                <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                    Electricity <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Usage Tracking</span>
                </h2>
            </div>
            <p style="color: #94a3b8; font-size: 1.1rem; margin-left: 56px;">Monitor consumption and generate monthly bills for approved farmers.</p>
        </div>

        <div class="glass-container">
            <div style="overflow-x: auto;">
                <table class="usage-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th>Farmer</th>
                            <th>Connection</th>
                            <th>Last Meter</th>
                            <th>Last Usage</th>
                            <th>Last Bill</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($farmers as $farmer)
                            @php $lastUsage = $farmer->powerUsages->first(); @endphp
                            <tr class="usage-row">
                                <td>
                                    <div style="display: flex; flex-direction: column;">
                                        <span style="font-weight: 800; color: #f1f5f9;">{{ $farmer->user->name }}</span>
                                        <span style="font-size: 0.75rem; color: #94a3b8;">{{ $farmer->village }}</span>
                                    </div>
                                </td>
                                <td style="font-family: monospace; color: #cbd5e1;">{{ $farmer->connection_no }}</td>
                                <td style="color: #38BDF8; font-weight: 700;">{{ $lastUsage ? $lastUsage->meter_reading : '---' }}</td>
                                <td style="color: #cbd5e1;">{{ $lastUsage ? $lastUsage->units_consumed . ' kWh' : '---' }}</td>
                                <td style="color: #10B981; font-weight: 700;">{{ $lastUsage ? '₹' . $lastUsage->bill_amount : '---' }}</td>
                                <td>
                                    <button class="btn-action btn-usage" onclick="openUsageModal({{ $farmer->id }}, '{{ $farmer->user->name }}')">
                                        <span>➕</span> Add Usage
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 100px 0;">
                                    <p style="color: #64748b; font-size: 1.2rem;">No approved farmers found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($farmers->hasPages())
                <div style="margin-top: 32px; display: flex; justify-content: center;">
                    {{ $farmers->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Usage Modal -->
    <div id="usageModal" class="modal">
        <div class="modal-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h3 id="modalTitle" style="color: #f1f5f9; font-size: 1.5rem; font-weight: 800; margin: 0;">Add Usage</h3>
                <button onclick="closeUsageModal()" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;">✕</button>
            </div>
            
            <form action="{{ route('admin.usage.store') }}" method="POST">
                @csrf
                <input type="hidden" name="farmer_id" id="modal_farmer_id">
                
                <label class="form-label">Billing Month</label>
                <input type="text" name="billing_month" value="{{ date('F Y') }}" class="form-input" required placeholder="e.g., May 2026">
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label class="form-label">Meter Reading</label>
                        <input type="number" step="0.01" name="meter_reading" class="form-input" required placeholder="0.00">
                    </div>
                    <div>
                        <label class="form-label">Units Consumed</label>
                        <input type="number" step="0.01" name="units_consumed" class="form-input" required placeholder="0.00">
                    </div>
                </div>
                
                <label class="form-label">Payment Status</label>
                <select name="payment_status" class="form-input" required>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                    <option value="overdue">Overdue</option>
                </select>

                <div style="margin-top: 12px; padding: 12px; background: rgba(56, 189, 248, 0.05); border-radius: 12px; border: 1px dashed rgba(56, 189, 248, 0.2);">
                    <p style="color: #64748b; font-size: 0.8rem; margin: 0; line-height: 1.5;">
                        <span style="color: #38BDF8;">💡</span> Bill will be calculated as <b>Units × ₹7</b> automatically.
                    </p>
                </div>

                <button type="submit" class="btn-action btn-usage" style="width: 100%; justify-content: center; padding: 14px; font-size: 1rem; margin-top: 32px;">
                    Generate Bill & Save
                </button>
            </form>
        </div>
    </div>

    <script>
        function openUsageModal(farmerId, farmerName) {
            document.getElementById('modal_farmer_id').value = farmerId;
            document.getElementById('modalTitle').innerText = 'Usage for ' + farmerName;
            document.getElementById('usageModal').classList.add('active');
        }

        function closeUsageModal() {
            document.getElementById('usageModal').classList.remove('active');
        }

        // Close modal on outside click
        window.onclick = function(event) {
            let modal = document.getElementById('usageModal');
            if (event.target == modal) {
                closeUsageModal();
            }
        }
    </script>
@endsection
