@extends('layouts.main')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome to FarmGrid')

@section('main-content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <div class="p-6 text-white">
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 16px;">{{ __("You're logged in!") }}</h3>
                    <p style="color: #cbd5e1; margin-bottom: 24px;">
                        Welcome to your FarmGrid account. You can access your dashboard below:
                    </p>
                    <div style="display: flex; gap: 16px;">
                        @if(Auth::user()->role === 'farmer')
                            <a href="{{ route('farmer.dashboard') }}" 
                               style="display: inline-block; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); color: white; font-weight: 700; padding: 12px 24px; border-radius: 12px; text-decoration: none; transition: all 0.3s ease;"
                               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(56, 189, 248, 0.3)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                Go to Farmer Dashboard →
                            </a>
                        @elseif(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" 
                               style="display: inline-block; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); color: white; font-weight: 700; padding: 12px 24px; border-radius: 12px; text-decoration: none; transition: all 0.3s ease;"
                               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(56, 189, 248, 0.3)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                Go to Admin Dashboard →
                            </a>
                        @elseif(Auth::user()->role === 'government')
                            <a href="{{ route('government.dashboard') }}" 
                               style="display: inline-block; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); color: white; font-weight: 700; padding: 12px 24px; border-radius: 12px; text-decoration: none; transition: all 0.3s ease;"
                               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(56, 189, 248, 0.3)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                Go to Government Dashboard →
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
