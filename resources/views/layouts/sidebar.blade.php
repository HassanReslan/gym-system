<div class="sidebar">
    <h2>@yield('title')</h2>
    <ul>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="">
                <i class="fa fa-home"></i> {{ __('Dashboard') }}
            </a>
        </li>
        <li class="{{ request()->routeIs('members.list') ? 'active' : '' }}">
            <a href="{{ route('members.list') }}" class="">
                <i class="fa fa-users"></i> {{ __('Members') }}
            </a>
        </li>
        <li class="{{ request()->routeIs('subscriptions.index') ? 'active' : '' }}">
            <a href="{{ route('subscriptions.index') }}" >
                <i class="fa fa-money-check-alt"></i> {{ __('subscriptions') }}
            </a>
        </li>
        <li class="{{ request()->routeIs('plans.index') ? 'active' : '' }}">        
            <a href="{{ route('plans.index') }}" >
                <i class="fa fa-tags"></i> {{ __('plans') }}
            </a>
        </li>
        <li class=" {{ request()->routeIs('trainers.index') ? 'active' : '' }}">
            <a href="{{ route('trainers.index') }}" >
                <i class="fas  fa-dumbbell"></i> {{ __('trainers') }}
            </a>
        </li>
    </ul>
  </div>