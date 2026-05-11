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
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(56, 189, 248, 0.3); 
            border-radius: 32px; 
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
        }

        .glass-field {
            background: rgba(2, 6, 23, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.2);
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
            transform: scale(1.01);
        }
        .glass-field::placeholder {
            color: rgba(148, 163, 184, 0.5);
        }

        .field-label {
            display: block;
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 16px;
            font-weight: 700;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
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

        .btn-primary-futuristic {
            background: linear-gradient(135deg, #38BDF8 0%, #1D4ED8 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        .btn-primary-futuristic:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.5);
        }

        .btn-secondary-futuristic {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(56, 189, 248, 0.3);
            color: #38BDF8;
        }
        .btn-secondary-futuristic:hover {
            background: rgba(56, 189, 248, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.2);
        }

        .info-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .info-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(56, 189, 248, 0.3);
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .avatar-glow {
            position: relative;
            display: inline-block;
        }
        .avatar-glow::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            border-radius: 50%;
            z-index: -1;
            filter: blur(10px);
            opacity: 0.6;
            animation: pulse-glow 3s ease-in-out infinite;
        }

        /* Modal Overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(15px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
    </style>

    <div x-data="{ 
        editModal: {{ $errors->any() && !$errors->updatePassword->any() ? 'true' : 'false' }}, 
        passwordModal: {{ $errors->updatePassword->any() ? 'true' : 'false' }} 
    }" style="padding: 20px 0;">
        
        <!-- Large Welcome Header -->
        <div style="margin-bottom: 48px;">
            <h2 style="font-size: 3rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -1px;">
                Welcome, <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ Auth::user()->name }}</span> 👋
            </h2>
            <p style="color: #94a3b8; font-size: 1.2rem; margin-top: 8px;">Manage your personal information and security settings.</p>
        </div>

        <!-- Main Profile Overview Card -->
        <div class="glass-panel" style="display: flex; padding: 60px; gap: 60px; align-items: flex-start; flex-wrap: wrap;">
            
            <!-- Left Side: Avatar -->
            <div style="flex: 1; min-width: 280px; display: flex; flex-direction: column; align-items: center; gap: 24px;">
                <div class="avatar-glow">
                    <div style="width: 220px; height: 220px; border-radius: 50%; border: 4px solid rgba(56, 189, 248, 0.4); overflow: hidden; background: #0f172a; display: flex; align-items: center; justify-content: center;">
                        @if(isset($user->profile_photo))
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span style="font-size: 6rem; font-weight: 800; color: #38BDF8; opacity: 0.8;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <button @click="editModal = true" style="position: absolute; bottom: 10px; right: 10px; width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); border: none; color: white; font-size: 1.2rem; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='scale(1.1) rotate(15deg)'"
                            onmouseout="this.style.transform='scale(1) rotate(0)'">
                        📷
                    </button>
                </div>
                <div style="text-align: center;">
                    <div style="display: inline-block; padding: 6px 16px; background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 100px; color: #38BDF8; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                        {{ ucfirst(Auth::user()->role) }} Member
                    </div>
                </div>
            </div>

            <!-- Right Side: User Information -->
            <div style="flex: 2; min-width: 320px; display: flex; flex-direction: column; gap: 24px;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                    <div class="info-card">
                        <p style="color: #64748b; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Full Name</p>
                        <p style="color: #f1f5f9; font-size: 1.1rem; font-weight: 600; margin: 0;">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="info-card">
                        <p style="color: #64748b; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Email Address</p>
                        <p style="color: #f1f5f9; font-size: 1.1rem; font-weight: 600; margin: 0;">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="info-card">
                        <p style="color: #64748b; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Phone Number</p>
                        <p style="color: #f1f5f9; font-size: 1.1rem; font-weight: 600; margin: 0;">{{ $user->phone ?? 'Not Linked' }}</p>
                    </div>
                    <div class="info-card">
                        <p style="color: #64748b; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">System Role</p>
                        <p style="color: #10B981; font-size: 1.1rem; font-weight: 700; margin: 0;">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
                
                <div class="info-card">
                    <p style="color: #64748b; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Personal Biography</p>
                    <p style="color: #cbd5e1; font-size: 1rem; line-height: 1.6; margin: 0;">
                        {{ $user->bio ?? 'No biography added yet. Update your profile to share more about yourself.' }}
                    </p>
                </div>

                <div style="display: flex; align-items: center; gap: 12px; color: #64748b; font-size: 0.85rem; padding-left: 8px;">
                    <span>🕒 Last Login:</span>
                    <span style="color: #94a3b8; font-weight: 600;">{{ now()->format('M d, Y - H:i') }}</span>
                    <span style="margin: 0 8px; opacity: 0.3;">|</span>
                    <span>📍 IP Address:</span>
                    <span style="color: #94a3b8; font-weight: 600;">{{ request()->ip() }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div style="display: flex; gap: 20px; margin-top: 40px; justify-content: center;">
            <button @click="editModal = true" class="btn-shine btn-primary-futuristic">
                <span>✏️</span> Edit Profile Information
            </button>
            <button @click="passwordModal = true" class="btn-shine btn-secondary-futuristic">
                <span>🔐</span> Change Access Password
            </button>
            <a href="{{ 
                Auth::user()->role === 'admin' ? route('admin.dashboard') : 
                (Auth::user()->role === 'government' ? route('government.dashboard') : 
                (Auth::user()->role === 'farmer' ? route('farmer.dashboard') : route('dashboard')))
            }}" class="btn-shine" style="background: rgba(255,255,255,0.05); color: #94a3b8; border: 1px solid rgba(255,255,255,0.1); text-decoration: none;">
                <span>⬅️</span> Return to Dashboard
            </a>
        </div>

        <!-- EDIT PROFILE MODAL -->
        <template x-if="editModal">
            <div class="modal-overlay" @click.self="editModal = false">
                <div class="glass-panel float-animation" style="width: 100%; max-width: 600px; padding: 40px; border-color: rgba(16, 185, 129, 0.4);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
                        <h3 style="font-size: 1.8rem; font-weight: 800; color: #f1f5f9; margin: 0;">✏️ Edit <span style="color: #10B981;">Profile</span></h3>
                        <button @click="editModal = false" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;">✕</button>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 24px;">
                        @csrf
                        @method('patch')

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="name" class="field-label"><span>👤</span> Full Name</label>
                            <input type="text" id="name" name="name" class="glass-field @error('name') border-red-500/50 @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="email" class="field-label"><span>📧</span> Email Address</label>
                            <input type="email" id="email" name="email" class="glass-field @error('email') border-red-500/50 @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email') <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="phone" class="field-label"><span>📞</span> Phone Number</label>
                            <input type="text" id="phone" name="phone" class="glass-field @error('phone') border-red-500/50 @enderror" value="{{ old('phone', $user->phone ?? '') }}" placeholder="+1 (555) 000-0000">
                            @error('phone') <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="bio" class="field-label"><span>📝</span> Biography</label>
                            <textarea id="bio" name="bio" rows="3" class="glass-field @error('bio') border-red-500/50 @enderror" style="resize: none;" placeholder="Tell us about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                            @error('bio') <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 12px; padding: 20px; background: rgba(56, 189, 248, 0.05); border: 1px dashed rgba(56, 189, 248, 0.2); border-radius: 20px;">
                            <label class="field-label"><span>🖼️</span> Profile Photo</label>
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div style="width: 64px; height: 64px; border-radius: 50%; border: 2px solid #38BDF8; overflow: hidden; background: #0f172a; display: flex; align-items: center; justify-content: center;">
                                    @if(isset($user->profile_photo))
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <span style="font-size: 1.5rem; color: #38BDF8;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <input type="file" name="profile_photo" style="color: #94a3b8; font-size: 0.85rem;">
                            </div>
                        </div>

                        <div style="display: flex; gap: 16px; margin-top: 12px;">
                            <button type="submit" class="btn-shine btn-primary-futuristic" style="flex: 2;">
                                Update Profile
                            </button>
                            <button type="button" @click="editModal = false" class="btn-shine" style="flex: 1; background: rgba(255,255,255,0.05); color: #94a3b8; border: 1px solid rgba(255,255,255,0.1);">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        <!-- CHANGE PASSWORD MODAL -->
        <template x-if="passwordModal">
            <div class="modal-overlay" @click.self="passwordModal = false">
                <div class="glass-panel float-animation" style="width: 100%; max-width: 500px; padding: 40px; border-color: rgba(56, 189, 248, 0.4);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
                        <h3 style="font-size: 1.8rem; font-weight: 800; color: #f1f5f9; margin: 0;">🔐 Change <span style="color: #38BDF8;">Password</span></h3>
                        <button @click="passwordModal = false" style="background: none; border: none; color: #94a3b8; font-size: 1.5rem; cursor: pointer;">✕</button>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" style="display: flex; flex-direction: column; gap: 24px;">
                        @csrf
                        @method('put')

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="current_password" class="field-label"><span>🔑</span> Current Password</label>
                            <input type="password" id="current_password" name="current_password" class="glass-field @error('current_password', 'updatePassword') border-red-500/50 @enderror" required>
                            @error('current_password', 'updatePassword') <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="password" class="field-label"><span>🆕</span> New Password</label>
                            <input type="password" id="password" name="password" class="glass-field @error('password', 'updatePassword') border-red-500/50 @enderror" required>
                            @error('password', 'updatePassword') <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label for="password_confirmation" class="field-label"><span>✅</span> Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="glass-field @error('password_confirmation', 'updatePassword') border-red-500/50 @enderror" required>
                            @error('password_confirmation', 'updatePassword') <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p> @enderror
                        </div>

                        <div style="display: flex; gap: 16px; margin-top: 12px;">
                            <button type="submit" class="btn-shine btn-primary-futuristic" style="flex: 2;">
                                Secure Account
                            </button>
                            <button type="button" @click="passwordModal = false" class="btn-shine" style="flex: 1; background: rgba(255,255,255,0.05); color: #94a3b8; border: 1px solid rgba(255,255,255,0.1);">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

    </div>
@endsection
