@php
$permission = null;

if(auth()->check() && auth()->user()->role == 'employee'){
    $permission = auth()->user()->employeePermission;
}
@endphp

<nav x-data="{ open: window.innerWidth >= 1024, collapsed: false }" @keydown.escape.window="open = false" :class="{ 'sidebar-collapsed': collapsed }" class="bg-white border-b border-gray-200 shadow-sm">

    <!-- Header -->
    <div class="relative flex items-center justify-between h-20 px-4">

        <!-- Hamburger -->
        <button @click="open = !open"
            class="text-2xl text-black focus:outline-none">
            ☰
        </button>

        <!-- Logo -->
        <a href="{{ route('dashboard') }}"
            class="absolute left-1/2 transform -translate-x-1/2">
            <img src="{{ asset('https://vivtronevcs.com/wp-content/uploads/2026/05/file_00000000d93c71fa8543361289614009-e1780049716431.png') }}"
                alt="Logo"
                class="h-14 w-20">
        </a>

      <!-- Profile Dropdown -->
<!-- Profile Dropdown -->
<div x-data="{ profileOpen: false }" class="relative">

    <button
        @click="profileOpen=!profileOpen"
        class="profile-trigger flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-2.5 py-1.5 text-left shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md focus:outline-none">

        <span class="relative block">
            <img
                id="headerProfileImage"
                src="{{ Auth::user()->profile_image ? asset('storage/'.Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=0B3B73&color=fff' }}"
                class="h-10 w-10 rounded-full border-2 border-white object-cover ring-2 ring-blue-100">
            <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500"></span>
        </span>

        <span class="hidden min-w-0 sm:block">
            <span class="block max-w-[210px] truncate text-sm font-bold uppercase tracking-wide text-[#0B3B73]">{{ Auth::user()->name }}</span>
            <span class="mt-0.5 block text-[11px] font-medium text-emerald-600">Active account</span>
        </span>

        <svg class="w-4 h-4"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">
            <path d="M19 9l-7 7-7-7"/>
        </svg>

    </button>

    <!-- Dropdown -->
    <div
        x-show="profileOpen"
        x-transition
        @click.away="profileOpen=false"
        class="profile-menu absolute right-0 mt-3 w-[22rem] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl z-50">

        <!-- Top -->
        <div class="bg-gradient-to-br from-[#0B3B73] via-[#1268D8] to-[#13A86B] p-6 text-center">

            <button type="button" onclick="document.getElementById('profileImage').click()" class="group relative mx-auto block rounded-full focus:outline-none" title="Change profile image">
                <img
                    id="profilePreview"
                    src="{{ Auth::user()->profile_image ? asset('storage/'.Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=0B3B73&color=fff' }}"
                    class="h-24 w-24 rounded-full border-4 border-white/90 object-cover shadow-lg">
                <span class="absolute inset-0 flex items-center justify-center rounded-full bg-black/45 text-xs font-bold text-white opacity-0 transition group-hover:opacity-100">Edit photo</span>
            </button>

            <h3 class="mt-3 text-xl font-bold text-white">
                {{ Auth::user()->name }}
            </h3>
            <p class="mt-1 text-xs text-blue-100">{{ Auth::user()->email }}</p>

        </div>

        <!-- Details -->
        <div class="space-y-3 p-5 text-sm">

            <p>
                <b>Name :</b>
                {{ Auth::user()->name }}
            </p>

            <p>
                <b>Email :</b>
                {{ Auth::user()->email }}
            </p>

            <p>
                <b>Role :</b>
                {{ Auth::user()->role }}
            </p>

            <p>
                <b>Status :</b>
                {{ Auth::user()->status }}
            </p>

          @php
    $rankData = \App\Http\Controllers\TeamController::getUserRank(Auth::user());
@endphp

<p>
    <b>Rank :</b>
   <span style="color: {{ $rankData['color'] }}; font-weight:bold;">
        {{ $rankData['rank'] }}
    </span>
</p>

            <p>
                <b>KYC :</b>
                {{ Auth::user()->kyc->status ?? 'Not Submitted' }}
            </p>

            <hr>

            <label class="font-semibold block">
                Upload Profile Image
            </label>

            <input id="profileImage" type="file" accept="image/*" onchange="uploadProfileImage(event)" class="hidden">

            <div class="grid grid-cols-2 gap-3 pt-2">
                <a href="{{ route('profile.edit') }}" class="rounded-lg bg-blue-50 px-3 py-2.5 text-center text-xs font-bold text-[#0B3B73] transition hover:bg-blue-100">View Profile</a>
                <button type="button" onclick="document.getElementById('profileImage').click()" class="rounded-lg bg-emerald-50 px-3 py-2.5 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100">Change Photo</button>
            </div>

            <button
                type="button"
                onclick="removeProfileImage()"
                class="mt-3 w-full bg-gray-700 hover:bg-gray-800 text-white py-2 rounded-lg">

                Remove Profile Image

            </button>

            <hr>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold">

                    🚪 Logout

                </button>

            </form>

        </div>

    </div>

</div>


    </div>

    <!-- Sidebar -->
    <div
        x-show="open"
        x-transition
        @click.away="open = false"
        class="fixed top-0 left-0 w-72 h-full bg-white shadow-2xl z-50 overflow-y-auto">

        <!-- Sidebar Header -->
        <div class="sidebar-header flex items-center justify-between p-4 border-b">
            <a href="{{ route('dashboard') }}" class="sidebar-brand flex items-center gap-2">
                <img src="{{ asset('https://vivtronevcs.com/wp-content/uploads/2026/05/file_00000000d93c71fa8543361289614009-e1780049716431.png') }}" alt="Vivtron EVCS" class="h-12 w-auto object-contain">
                <span class="sidebar-brand-label text-sm font-bold tracking-wide text-white">VIVTRON EVCS</span>
            </a>

            <div class="flex items-center gap-1">
                <button type="button" @click="collapsed = !collapsed" class="sidebar-collapse hidden rounded-lg px-2 py-1 text-xl text-white hover:bg-white/10" :title="collapsed ? 'Expand sidebar' : 'Collapse sidebar'" :aria-label="collapsed ? 'Expand sidebar' : 'Collapse sidebar'">
                    <span x-text="collapsed ? '»' : '«'"></span>
                </button>
                <button type="button" @click="open = false" class="sidebar-close rounded-lg px-2 py-1 text-2xl text-white hover:bg-white/10" title="Close sidebar" aria-label="Close sidebar">x</button>
            </div>
        </div>

        <ul class="py-3">

            <!-- USER PANEL -->

            <li class="sidebar-section-label">Workspace</li>

            <li>
                <a href="/dashboard" class="block px-6 py-3 hover:bg-gray-100">
                    🏠 Dashboard
                </a>
            </li>

            <li>
                <a href="/kyc" class="block px-6 py-3 hover:bg-gray-100">
                    ✅ KYC
                </a>
            </li>

            <li>
                <a href="/bank" class="block px-6 py-3 hover:bg-gray-100">
                    🏦 Bank Details
                </a>
            </li>

            <li>
            <a href="{{ route('purchase.create') }}" class="block px-6 py-3 hover:bg-gray-100"> 👤 Product Purchase</a>
          </li>

          <li>
    <a href="{{ route('purchase.list') }}" class="block px-6 py-3 hover:bg-gray-100">
        📦 My Purchases
    </a>
</li>

            <li>
                <a href="/income" class="block px-6 py-3 hover:bg-gray-100">
                    💰 Income History
                </a>
            </li>

            <li>
                <a href="/withdrawals" class="block px-6 py-3 hover:bg-gray-100">
                    💸 Withdrawals
                </a>
            </li>

            <li>
                <a href="/my-team" class="block px-6 py-3 hover:bg-gray-100">
                    👥 My Team
                </a>
            </li>

            <li>
                <a href="/team-tree" class="block px-6 py-3 hover:bg-gray-100">
                    🌳 Team Tree
                </a>
            </li>

            <li>
                <a href="{{ route('stations.index') }}" class="block px-6 py-3 hover:bg-gray-100">
                    ⚡ Recharge Stations
                </a>
            </li>

            <li>
                <a href="/profile" class="block px-6 py-3 hover:bg-gray-100">
                    👤 Profile
                </a>
            </li>

            <hr class="my-3">

            <!-- ADMIN PANEL -->

         

          @if(auth()->user()->role == 'admin')

   <li class="px-6 py-2 text-gray-500 font-bold uppercase text-sm">
                Admin Panel
            </li>

<li><a href="/admin/stations" class="block px-6 py-3">📍 Station Locations</a></li>
<li><a href="/admin" class="block px-6 py-3">📊 Admin Dashboard</a></li>
<li><a href="/admin/kycs" class="block px-6 py-3">✅ KYC Management</a></li>
<li><a href="/admin/sales" class="block px-6 py-3">📈 Sales Management</a></li>
<li><a href="/admin/income" class="block px-6 py-3">💰 Income Management</a></li>
<li><a href="/admin/withdrawals" class="block px-6 py-3">💳 Withdrawals Management</a></li>
<li><a href="/admin/rewards" class="block px-6 py-3">🎁 Rewards</a></li>
<li><a href="/admin/banks" class="block px-6 py-3">🏦 Banks Approval</a></li>
<li><a href="/admin/ranks" class="block px-6 py-3">🏅 Rank Settings</a></li>
<li><a href="/admin/reward-settings" class="block px-6 py-3">🎁 Reward Settings</a></li>
<li><a href="/admin/royalty-settings" class="block px-6 py-3">👑 Royalty Settings</a></li>
<li><a href="/admin/level-settings" class="block px-6 py-3">📊 Level Settings</a></li>
<li><a href="/admin/employees" class="block px-6 py-3">👨‍💼 Employee Management</a></li>
<li>
    <a href="{{ route('admin.purchases') }}" class="block px-6 py-3">
        🛒 Purchase Requests
    </a>
</li>

@endif


@if(auth()->user()->role == 'employee' && $permission)

<li class="px-6 py-2 text-gray-500 font-bold uppercase text-sm">
    Employee Access
</li>

@if($permission->users_access)
<li>
    <a href="/admin" class="block px-6 py-3 hover:bg-gray-100">
        👥 Users
    </a>
</li>
@endif

@if($permission->kyc_access)
<li>
    <a href="/admin/kycs" class="block px-6 py-3 hover:bg-gray-100">
        ✔ KYC Management
    </a>
</li>
@endif

@if($permission->sales_access)
<li>
    <a href="/admin/sales" class="block px-6 py-3 hover:bg-gray-100">
        📈 Sales Management
    </a>
</li>
@endif

@if($permission->income_access)
<li>
    <a href="/admin/income" class="block px-6 py-3 hover:bg-gray-100">
        💰 Income Management
    </a>
</li>
@endif

@if($permission->withdrawal_access)
<li>
    <a href="/admin/withdrawals" class="block px-6 py-3 hover:bg-gray-100">
        💳 Withdrawals Management
    </a>
</li>
@endif

@if($permission->reward_access)
<li>
    <a href="/admin/rewards" class="block px-6 py-3 hover:bg-gray-100">
        🎁 Rewards
    </a>
</li>
@endif

@if($permission->bank_access)
<li>
    <a href="/admin/banks" class="block px-6 py-3 hover:bg-gray-100">
        🏦 Banks Approval
    </a>
</li>
@endif

@if($permission->rank_access)
<li>
    <a href="/admin/ranks" class="block px-6 py-3 hover:bg-gray-100">
        🏅 Rank Settings
    </a>
</li>
@endif

@if($permission->reward_setting_access)
<li>
    <a href="/admin/reward-settings" class="block px-6 py-3 hover:bg-gray-100">
        🎁 Reward Settings
    </a>
</li>
@endif

@if($permission->royalty_access)
<li>
    <a href="/admin/royalty-settings" class="block px-6 py-3 hover:bg-gray-100">
        👑 Royalty Settings
    </a>
</li>
@endif

@if($permission->level_access)
<li>
    <a href="/admin/level-settings" class="block px-6 py-3 hover:bg-gray-100">
        📚 Level Settings
    </a>
</li>
@endif

@endif

            <!-- LOGOUT -->

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-6 py-3 hover:bg-red-100 text-red-600 font-semibold">
                        🚪 Logout
                    </button>
                </form>
            </li>

        </ul>

    </div>

</nav>


<script>

const defaultAvatar =
"https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff";

function uploadProfileImage(event){

    const file = event.target.files[0];

    if(!file) return;

    let formData = new FormData();
    formData.append('profile_image', file);

    fetch("{{ route('profile.upload.image') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        console.log(data);

        if(data.success){

            document.getElementById("profilePreview").src =
                data.image + '?' + new Date().getTime();

            document.getElementById("headerProfileImage").src =
                data.image + '?' + new Date().getTime();

            alert("Profile image updated successfully");

        }else{

            alert("Upload failed");

        }

    })
    .catch(error => {
        console.log(error);
        alert("Upload error");
    });

}

function removeProfileImage(){

    if(confirm("Remove profile image?")){

        document.getElementById("profilePreview").src = defaultAvatar;
        document.getElementById("headerProfileImage").src = defaultAvatar;
        document.getElementById("profileImage").value = "";

    }

}

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const currentPath = window.location.pathname.replace(/\/$/, '') || '/';
        const sidebar = document.querySelector('nav > div[class*="w-72"]');

        if (!sidebar) return;

        sidebar.querySelectorAll('a[href]').forEach(function (link) {
            const href = link.getAttribute('href');
            if (!href || href.startsWith('#') || href.startsWith('mailto:')) return;

            let linkPath;
            try {
                linkPath = new URL(href, window.location.origin).pathname.replace(/\/$/, '') || '/';
            } catch (error) {
                return;
            }

            const isCurrent = linkPath === currentPath ||
                (linkPath !== '/' && currentPath.startsWith(linkPath + '/'));

            if (isCurrent) {
                link.classList.add('sidebar-link-active');
                link.setAttribute('aria-current', 'page');
            }
        });
    });
</script>

<script>

const defaultAvatar =
"https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff";

function uploadProfileImage(event){

    alert('Function Working');

    const file = event.target.files[0];

    if(!file) return;

    let formData = new FormData();

    formData.append('profile_image', file);

    fetch("{{ route('profile.upload.image') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        console.log(data);

        if(data.success){

            document.getElementById("profilePreview").src = data.image;
            document.getElementById("headerProfileImage").src = data.image;

            alert("Profile image updated successfully");

        }

    })
    .catch(error => {
        console.log(error);
        alert("Upload error");
    });

}

</script>
