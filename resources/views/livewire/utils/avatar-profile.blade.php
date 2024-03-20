<div class="profile-box ml-15">
    <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile" data-bs-toggle="dropdown"
        aria-expanded="false">
        <div class="profile-info">
            <div class="info">
                <div class="image">
                    <img src="{{ getProfileImage() }}" alt="" />
                </div>
                <div class="d-none d-lg-block">
                    <h6 class="fw-500">{{ auth()?->user()?->name }}</h6>
                    <p>Admin</p>
                </div>
            </div>
        </div>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
        <li>
            <div class="author-info flex items-center !p-1">
                <div class="image">
                    <img src="{{ getProfileImage() }}" alt="image">
                </div>
                <div class="content">
                    <h4 class="text-sm">{{ auth()?->user()?->name }}</h4>
                    <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                        href="mailto:{{ auth()?->user()?->email }}">{{ auth()?->user()?->email }}</a>
                </div>
            </div>
        </li>
        <li class="divider"></li>
        <li>
            <a wire:navigate href="{{ route('profile') }}">
                <i class="lni lni-user"></i> View Profile
            </a>
        </li>
        <li>
            <a href="#0">
                <i class="lni lni-alarm"></i> Notifications
            </a>
        </li>

        <li>
            <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="#0" x-on:click="$refs.signout.submit()"> <i class="lni lni-exit"></i> Sign Out </a>
            <form action="{{ route('logout') }}" x-ref="signout" method="POST">
                @csrf
            </form>
        </li>
    </ul>
</div>