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
        @keyframes shine-sweep {
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
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(56, 189, 248, 0.2); 
            border-radius: 32px; 
            padding: 48px; 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .form-label {
            display: block;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            margin-left: 4px;
        }

        .glass-field {
            background: rgba(2, 6, 23, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 16px;
            padding: 14px 20px;
            color: #f1f5f9;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1rem;
        }
        .glass-field:focus {
            outline: none;
            border-color: #38BDF8;
            background: rgba(56, 189, 248, 0.05);
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.15);
            transform: scale(1.02);
        }

        .btn-submit {
            background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%);
            color: white;
            border: none;
            padding: 16px 40px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }
        .btn-submit:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.5);
        }
        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shine-sweep 3s infinite;
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            padding: 16px 32px;
            border-radius: 16px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-cancel:hover {
            background: rgba(56, 189, 248, 0.1);
            border-color: rgba(56, 189, 248, 0.3);
            color: #38BDF8;
            transform: translateY(-2px);
        }

        select option {
            background-color: #0f172a;
            color: white;
            padding: 10px;
        }
    </style>

    <div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 40px; padding: 20px 0;">
        
        <!-- Header Section -->
        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 20px;">
            <div class="pulse-glow" style="width: 80px; height: 80px; background: rgba(56, 189, 248, 0.1); border-radius: 24px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                🔧
            </div>
            <div>
                <h2 style="font-size: 2.8rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -1px;">
                    Report <span style="background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Electricity Issue</span>
                </h2>
                <p style="color: #94a3b8; font-size: 1.15rem; margin-top: 12px; max-width: 600px; line-height: 1.6;">
                    Submit electricity-related issues for fast smart-grid monitoring and regional resolution.
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-panel float-animation">
            <form action="{{ route('farmer.complaint.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 32px;">
                @csrf

                <!-- Connection Selection -->
                <div>
                    <label class="form-label">
                        <span style="color: #38BDF8; font-size: 1rem; margin-right: 6px;">🔌</span> Select Connection
                    </label>
                    <select name="farmer_id" required class="glass-field" style="cursor: pointer;">
                        @foreach($connections as $conn)
                            <option value="{{ $conn->id }}">{{ $conn->connection_no }} ({{ $conn->village }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Complaint Type -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div>
                        <label class="form-label">
                            <span style="color: #38BDF8; font-size: 1rem; margin-right: 6px;">📂</span> Issue Category
                        </label>
                        <select name="complaint_type" required class="glass-field" style="cursor: pointer;">
                            <option value="" disabled selected>Select issue category...</option>
                            <option value="no_electricity">No Electricity Supply</option>
                            <option value="low_voltage">Low Voltage</option>
                            <option value="transformer_issue">Transformer Problem</option>
                            <option value="line_fault">Line Fault</option>
                            <option value="billing_issue">Billing Issue</option>
                            <option value="meter_problem">Meter Problem</option>
                            <option value="other">Other Issues</option>
                        </select>
                    </div>

                    <!-- Priority -->
                    <div>
                        <label class="form-label">
                            <span style="color: #F59E0B; font-size: 1rem; margin-right: 6px;">⚡</span> Urgency Level
                        </label>
                        <select name="priority" class="glass-field" style="cursor: pointer;">
                            <option value="low">Low - Routine Issue</option>
                            <option value="medium" selected>Medium - Standard Priority</option>
                            <option value="high">High - Urgent Response</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="form-label">
                        <span style="color: #10B981; font-size: 1rem; margin-right: 6px;">📝</span> Problem Details
                    </label>
                    <textarea name="description" rows="5" required class="glass-field" style="resize: none;" placeholder="Please provide specific details about the issue..."></textarea>
                </div>

                <!-- Footer Actions -->
                <div style="margin-top: 20px; padding-top: 40px; border-top: 1px solid rgba(56, 189, 248, 0.1); display: flex; align-items: center; justify-content: space-between;">
                    <a href="{{ route('farmer.complaints') }}" class="btn-cancel">
                        <span>←</span> Back to Status List
                    </a>

                    <button type="submit" class="btn-submit">
                        Transmit Complaint ➔
                    </button>
                </div>
            </form>
        </div>

        <!-- System Protocol Card -->
        <div style="padding: 24px; background: rgba(56, 189, 248, 0.03); border: 1px dashed rgba(56, 189, 248, 0.2); border-radius: 24px; display: flex; align-items: center; gap: 20px;">
            <div class="pulse-glow" style="font-size: 2rem;">🛡️</div>
            <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                <strong style="color: #f1f5f9;">Resolution Protocol:</strong> 
                Once submitted, your request is assigned a unique tracking ID and routed to the regional grid team. Most issues are diagnosed within <span style="color: #38BDF8; font-weight: 800;">12-24 hours</span>. Please keep your connection details ready for verification.
            </p>
        </div>
    </div>
@endsection