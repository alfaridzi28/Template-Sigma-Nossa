{{-- sidebar --}}
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <div id="sidebar-menu">
            @if (\Str::contains(auth()->user()->module, ['all', 'user']))
            <ul class="metismenu">
                <li class="menu-title">User Management</li>
                <li><a href="{{ route('user.index') }}" class="waves-effect"><i class="dripicons-search"></i> <span>
                            List User </span></a></li>
                <li><a href="{{ route('module.index') }}" class="waves-effect"><i class="dripicons-document-edit"></i>
                        <span> List Module </span></a></li>
                <li><a href="{{ route('capacity.index') }}" class="waves-effect"><i class="dripicons-archive"></i>
                        <span> Master Capacity </span></a></li>
                <li><a href="{{ route('profillingbcp.index') }}" class="waves-effect"><i class="dripicons-archive"></i>
                        <span> Profilling BCP </span></a></li>
            </ul>
            @endif

            @foreach ($modules as $module)
            <ul class="metismenu">
                <li class="menu-title">{{ $module->title }}</li>
                @foreach ($module->submodules as $submodule)
                @if (\Str::contains(auth()->user()->module, ['all', $submodule->slug]) || auth()->user()->ldap)
                <li><a href="{{ route('user.menu', $submodule->id) }}" class="waves-effect"><i
                            class="dripicons-expand"></i>
                        <span> {{ $submodule->subtitle }} </span>
                    </a></li>
                @endif
                @endforeach
            </ul>
            @endforeach

        </div>

        <div class="clearfix"></div>

    </div>
</div>